<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\Order;
use App\Models\User;
use App\Models\Category;

class AdminController extends Controller
{
    /* ================= DASHBOARD ================= */
    public function dashboard(){
        return view('admin.dashboard', [
            'phones' => Phone::count(),
            'orders' => Order::count(),
            'users' => User::count()
        ]);
    }

    /* ================= PRODUCT ================= */
    public function phones(){
        $phones = Phone::with('category')->get();
        return view('admin.phones', compact('phones'));
    }

    /* ================= CREATE ================= */
    public function create(){
        $categories = Category::all(); // ✅ fix lỗi dropdown
        return view('admin.create_phone', compact('categories'));
    }

    /* ================= STORE ================= */
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
            'category_id' => $request->category_id
        ]);

        return redirect('/admin/phones')->with('success','Thêm sản phẩm thành công!');
    }

    /* ================= EDIT ================= */
    public function edit($id){
        $phone = Phone::findOrFail($id);
        $categories = Category::all();

        return view('admin.edit_phone', compact('phone','categories'));
    }

    /* ================= UPDATE ================= */
    public function update(Request $request, $id){
        $phone = Phone::findOrFail($id);

        $fileName = $phone->image;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);
        }

        $phone->update([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $fileName,
            'description' => $request->description,
            'category_id' => $request->category_id
        ]);

        return redirect('/admin/phones')->with('success','Cập nhật thành công!');
    }

    /* ================= DELETE ================= */
    public function delete($id){
        Phone::destroy($id);
        return back()->with('success','Đã xóa!');
    }

    /* ================= ORDER DETAILS & ACTIONS ================= */
    public function orders(){
        $orders = Order::with(['user', 'items.phone'])->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function updateOrderStatus($id, $status){
        $order = Order::findOrFail($id);
        $order->status = $status;
        $order->save();

        return back()->with('success','Đã cập nhật trạng thái đơn hàng!');
    }

    public function deleteOrder($id){
        Order::destroy($id);
        return back()->with('success','Đã xóa đơn hàng!');
    }

    /* ================= USERS ================= */
    public function users(){
        $users = User::latest()->get();
        return view('admin.users', compact('users'));
    }
}