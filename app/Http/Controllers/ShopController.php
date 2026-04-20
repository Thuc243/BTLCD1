<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Category;
use App\Models\Review;

class ShopController extends Controller
{
    public function home(Request $request){

        $categories = Category::all();

        $query = Phone::query();

        if($request->keyword){
            $query->where('name','like','%'.$request->keyword.'%');
        }

        if($request->category){
            $query->where('category_id',$request->category);
        }

        $phones = $query->paginate(12);

        $featured = Phone::where('is_featured',1)->take(8)->get();
        $bestSeller = Phone::orderBy('sold','desc')->take(8)->get();

        return view('user.home', compact(
            'phones','categories','featured','bestSeller'
        ));
    }

    public function detail($id){
        $phone = Phone::with('category')->findOrFail($id);
        $related = Phone::where('category_id', $phone->category_id)
                        ->where('id', '!=', $id)
                        ->take(4)
                        ->get();
        $categories = Category::all();

        // Load reviews gốc (không phải reply) kèm replies và user
        $reviews = Review::with(['user', 'replies.user'])
                    ->where('phone_id', $id)
                    ->whereNull('parent_id')
                    ->latest()
                    ->get();

        // Tính thống kê đánh giá
        $avgRating = $phone->avgRating();
        $reviewCount = $phone->reviewCount();
        $ratingDistribution = [];
        for ($i = 5; $i >= 1; $i--) {
            $count = Review::where('phone_id', $id)->whereNull('parent_id')->where('rating', $i)->count();
            $ratingDistribution[$i] = $count;
        }

        // Kiểm tra user đã đánh giá chưa và có quyền đánh giá không
        $userReview = null;
        $canReview = false;
        if (Auth::check()) {
            $userReview = Review::where('phone_id', $id)
                            ->where('user_id', Auth::id())
                            ->whereNull('parent_id')
                            ->first();

            // Chỉ user đã mua sản phẩm này và đơn hàng hoàn tất mới được đánh giá
            $canReview = Order::where('user_id', Auth::id())
                ->where('status', 'completed')
                ->whereHas('items', function($q) use ($id){
                    $q->where('phone_id', $id);
                })->exists();
        }

        return view('user.detail', compact(
            'phone', 'related', 'categories',
            'reviews', 'avgRating', 'reviewCount', 'ratingDistribution', 'userReview', 'canReview'
        ));
    }

    public function category($id){
        $cat = Category::findOrFail($id);
        $phones = Phone::where('category_id',$id)->get();
        $categories = Category::all();
        return view('user.category', compact('phones','categories','cat'));
    }

    public function add($id){
        $phone = Phone::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])){
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                'name'=>$phone->name,
                'price'=>$phone->price,
                'image'=>$phone->image,
                'qty'=>1
            ];
        }

        session()->put('cart',$cart);
        return redirect()->back()->with('cart_success', 'Đã thêm "'.$phone->name.'" vào giỏ hàng!');
    }

    public function cart(){
        $cart = session('cart', []);
        $categories = Category::all();
        return view('user.cart', compact('cart', 'categories'));
    }

    public function updateCart(Request $request,$id){
        $cart = session()->get('cart', []);
        if(isset($cart[$id])){
            $cart[$id]['qty'] = max(1, $request->qty);
        }
        session()->put('cart',$cart);
        return redirect('/cart');
    }

    public function remove($id){
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart',$cart);
        return redirect('/cart');
    }

    public function checkout(){
        $cart = session('cart', []);
        if(!$cart) return redirect('/');

        $total = 0;
        foreach($cart as $item){
            $total += $item['price'] * $item['qty'];
        }

        $categories = Category::all();
        return view('user.checkout', compact('cart','total','categories'));
    }

    public function order(Request $request){
        $cart = session('cart');
        if(!$cart) return redirect('/');

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'payment' => 'required|in:COD,QR',
        ]);

        $total = 0;
        foreach($cart as $item){
            $total += $item['price'] * $item['qty'];
        }

        $order = Order::create([
            'user_id'=>Auth::id(),
            'customer_name'=>$request->customer_name,
            'phone_number'=>$request->phone_number,
            'address'=>$request->address,
            'total'=>$total,
            'status'=>'pending',
            'payment_method'=>$request->payment
        ]);

        foreach($cart as $id=>$item){
            OrderItem::create([
                'order_id'=>$order->id,
                'phone_id'=>$id,
                'quantity'=>$item['qty'],
                'price'=>$item['price']
            ]);

            Phone::where('id',$id)->increment('sold',$item['qty']);
        }

        session()->forget('cart');

        return redirect('/orders')->with('success', 'Đặt hàng thành công! Mã đơn hàng: #ORD-'.$order->id);
    }

    public function orders(){
        $orders = Order::with(['items.phone'])->where('user_id',Auth::id())->latest()->get();
        $categories = Category::all();
        return view('user.orders', compact('orders', 'categories'));
    }

    /**
     * Lưu đánh giá + bình luận sản phẩm
     */
    public function storeReview(Request $request, $phoneId){
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|min:5|max:1000',
        ]);

        $canReview = Order::where('user_id', Auth::id())
                ->where('status', 'completed')
                ->whereHas('items', function($q) use ($phoneId){
                    $q->where('phone_id', $phoneId);
                })->exists();

        if (!$canReview && auth()->user()->role !== 'admin') {
            return redirect()->back()->withErrors(['review' => 'Bạn cần mua sản phẩm này và đơn hàng đã hoàn tất để có thể đánh giá.']);
        }

        // Kiểm tra đã đánh giá chưa
        $existing = Review::where('phone_id', $phoneId)
                        ->where('user_id', Auth::id())
                        ->whereNull('parent_id')
                        ->first();

        if ($existing) {
            // Cập nhật đánh giá cũ
            $existing->update([
                'rating' => $request->rating,
                'content' => $request->content,
            ]);
            return redirect()->back()->with('review_success', 'Đã cập nhật đánh giá của bạn!');
        }

        Review::create([
            'phone_id' => $phoneId,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('review_success', 'Cảm ơn bạn đã đánh giá sản phẩm!');
    }

    /**
     * Trả lời bình luận
     */
    public function replyReview(Request $request, $reviewId){
        $request->validate([
            'content' => 'required|string|min:2|max:1000',
        ]);

        $parent = Review::findOrFail($reviewId);

        Review::create([
            'phone_id' => $parent->phone_id,
            'user_id' => Auth::id(),
            'parent_id' => $reviewId,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('review_success', 'Đã gửi phản hồi!');
    }

    /**
     * Xóa bình luận (chủ sở hữu hoặc admin)
     */
    public function deleteReview($id){
        $review = Review::findOrFail($id);

        if (Auth::id() !== $review->user_id && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $review->delete(); // cascade xóa replies
        return redirect()->back()->with('review_success', 'Đã xóa bình luận!');
    }
}