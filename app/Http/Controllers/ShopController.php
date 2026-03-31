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

        $phones = $query->paginate(8);

        $featured = Phone::where('is_featured',1)->take(8)->get();
        $bestSeller = Phone::orderBy('sold','desc')->take(8)->get();

        return view('user.home', compact(
            'phones','categories','featured','bestSeller'
        ));
    }

    public function category($id){
        $phones = Phone::where('category_id',$id)->get();
        $categories = Category::all();
        return view('user.category', compact('phones','categories'));
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
        return redirect('/cart');
    }

    public function cart(){
        $cart = session('cart', []);
        return view('user.cart', compact('cart'));
    }

    public function updateCart(Request $request,$id){
        $cart = session()->get('cart', []);
        if(isset($cart[$id])){
            $cart[$id]['qty'] = $request->qty;
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

        return view('user.checkout', compact('cart','total'));
    }

    public function order(Request $request){
        $cart = session('cart');
        if(!$cart) return redirect('/');

        $total = 0;
        foreach($cart as $item){
            $total += $item['price'] * $item['qty'];
        }

        $order = Order::create([
            'user_id'=>Auth::id(),
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

        return redirect('/orders');
    }

    public function orders(){
        $orders = Order::where('user_id',Auth::id())->latest()->get();
        return view('user.orders', compact('orders'));
    }
}