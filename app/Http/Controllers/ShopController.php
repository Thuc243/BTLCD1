<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Category;

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
        return view('user.detail', compact('phone', 'related', 'categories'));
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
}