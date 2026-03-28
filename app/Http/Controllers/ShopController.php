<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\Order;
use App\Models\OrderItem;

class ShopController extends Controller
{
    public function home(){
        $phones = Phone::all();
        return view('user.home', compact('phones'));
    }

    public function add($id){
        $phone = Phone::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])){
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                'name' => $phone->name,
                'price' => $phone->price,
                'qty' => 1
            ];
        }

        session()->put('cart', $cart);
        return redirect('/cart');
    }

    public function cart(){
        return view('user.cart');
    }

    public function checkout(){
        $cart = session('cart', []);
        
        if(!$cart) return redirect('/');
        
        return view('user.checkout');
    }

    public function remove($id){
        $cart = session()->get('cart', []);

        if(isset($cart[$id])){
            unset($cart[$id]);
        }

        session()->put('cart', $cart);
        return redirect('/cart');
    }

    public function order(Request $request){
        $cart = session('cart');

        if(!$cart) return redirect('/');

        $total = 0;
        foreach($cart as $item){
            $total += $item['price'] * $item['qty'];
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'status' => 'pending',
            'payment_method' => $request->payment
        ]);

        foreach($cart as $id => $item){
            OrderItem::create([
                'order_id' => $order->id,
                'phone_id' => $id,
                'quantity' => $item['qty'],
                'price' => $item['price']
            ]);
        }

        session()->forget('cart');

        return redirect('/orders');
    }

    public function orders(){
        $orders = Order::where('user_id', Auth::id())->get();
        return view('user.orders', compact('orders'));
    }
}