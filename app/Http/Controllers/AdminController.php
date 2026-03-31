<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\Order;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard', [
            'phones' => Phone::count(),
            'orders' => Order::count(),
            'users' => User::count()
        ]);
    }

    public function phones(){
        $phones = Phone::all();
        return view('admin.phones', compact('phones'));
    }

    public function orders(){
        $orders = Order::all();
        return view('admin.orders', compact('orders'));
    }

    public function create(){
    return view('admin.create_phone');
}

    public function store(Request $request){
    $fileName = null;

    if($request->hasFile('image')){
        $file = $request->file('image');
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $fileName);
    }

    Phone::create([
        'name' => $request->name,
        'price' => $request->price,
        'image' => $fileName,
        'description' => $request->description,
        'category_id' => $request->category_id // ✅ FIX QUAN TRỌNG
    ]);

    return redirect('/admin/phones');
}

    public function delete($id){
        Phone::destroy($id);
        return back();
}

    public function users(){
        $users = User::all();
        return view('admin.users', compact('users'));
    }
}

