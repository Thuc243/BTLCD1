<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\Order;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /* ================= DASHBOARD ================= */
    public function dashboard(){
        $totalRevenue = Order::where('status', 'completed')->sum('total');
        $pendingOrders = Order::where('status', 'pending')->count();
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $topProducts = Phone::orderBy('sold', 'desc')->take(5)->get();

        // Dữ liệu biểu đồ doanh thu 7 ngày gần nhất
        $chartLabels = [];
        $chartData = [];
        for($i = 6; $i >= 0; $i--){
            $date = now()->subDays($i);
            $chartLabels[] = $date->format('d/m');
            $chartData[] = Order::where('status', 'completed')
                                ->whereDate('created_at', $date)
                                ->sum('total');
        }

        return view('admin.dashboard', [
            'phones' => Phone::count(),
            'orders' => Order::count(),
            'users' => User::count(),
            'totalRevenue' => $totalRevenue,
            'pendingOrders' => $pendingOrders,
            'recentOrders' => $recentOrders,
            'topProducts' => $topProducts,
            'chartLabels' => json_encode($chartLabels),
            'chartData' => json_encode($chartData),
        ]);
    }

    /* ================= PRODUCT ================= */
    public function phones(Request $request){
        $query = Phone::with('category');

        if($request->keyword){
            $query->where('name', 'like', '%'.$request->keyword.'%');
        }
        if($request->category_id){
            $query->where('category_id', $request->category_id);
        }

        $phones = $query->latest()->paginate(10);
        $categories = Category::all();
        return view('admin.phones', compact('phones', 'categories'));
    }

    /* ================= CREATE ================= */
    public function create(){
        $categories = Category::all();
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
            'category_id' => $request->category_id,
            'is_featured' => $request->has('is_featured') ? 1 : 0,
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
            'category_id' => $request->category_id,
            'is_featured' => $request->has('is_featured') ? 1 : 0,
        ]);

        return redirect('/admin/phones')->with('success','Cập nhật thành công!');
    }

    /* ================= DELETE ================= */
    public function delete($id){
        Phone::destroy($id);
        return back()->with('success','Đã xóa!');
    }

    /* ================= CATEGORIES ================= */
    public function categories(){
        $categories = Category::withCount('phones')->get();
        return view('admin.categories', compact('categories'));
    }

    public function storeCategory(Request $request){
        $request->validate(['name' => 'required|string|max:100|unique:categories']);
        Category::create(['name' => $request->name]);
        return back()->with('success', 'Thêm danh mục thành công!');
    }

    public function updateCategory(Request $request, $id){
        $cat = Category::findOrFail($id);
        $request->validate(['name' => 'required|string|max:100|unique:categories,name,'.$id]);
        $cat->update(['name' => $request->name]);
        return back()->with('success', 'Cập nhật danh mục thành công!');
    }

    public function deleteCategory($id){
        Category::destroy($id);
        return back()->with('success', 'Đã xóa danh mục!');
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