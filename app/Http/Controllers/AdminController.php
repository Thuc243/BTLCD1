<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\Order;
use App\Models\User;
use App\Models\Category;
use App\Models\Review;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /* ================= DASHBOARD ================= */
    public function dashboard(){
        $totalRevenue = Order::where('status', 'completed')->sum('total');
        $pendingOrders = Order::where('status', 'pending')->count();
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $topProducts = Phone::orderBy('sold', 'desc')->take(5)->get();

        // Thống kê hôm nay
        $todayOrders = Order::whereDate('created_at', today())->count();
        $todayRevenue = Order::where('status', 'completed')->whereDate('created_at', today())->sum('total');

        // Tổng đánh giá
        $totalReviews = Review::whereNull('parent_id')->count();
        $avgAllRating = Review::whereNull('parent_id')->whereNotNull('rating')->avg('rating') ?? 0;

        // Tỷ lệ hoàn thành đơn
        $totalOrders = Order::count();
        $completedOrders = Order::where('status', 'completed')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();
        $completionRate = $totalOrders > 0 ? round(($completedOrders / $totalOrders) * 100, 1) : 0;

        // Tổng sản phẩm đã bán
        $totalSold = Phone::sum('sold');

        // Đánh giá gần đây
        $recentReviews = Review::with(['user', 'phone'])
                        ->whereNull('parent_id')
                        ->latest()
                        ->take(5)
                        ->get();

        // Top sản phẩm đánh giá cao nhất
        $topRatedProducts = Phone::withCount(['reviews as avg_rating' => function($q) {
            $q->whereNull('parent_id')->whereNotNull('rating')->select(DB::raw('coalesce(avg(rating), 0)'));
        }])->orderByDesc('avg_rating')->take(5)->get();

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

        // Phân bố trạng thái đơn hàng
        $orderStatusData = [
            'pending' => $pendingOrders,
            'completed' => $completedOrders,
            'cancelled' => $cancelledOrders,
        ];

        return view('admin.dashboard', [
            'phones' => Phone::count(),
            'orders' => $totalOrders,
            'users' => User::count(),
            'totalRevenue' => $totalRevenue,
            'pendingOrders' => $pendingOrders,
            'recentOrders' => $recentOrders,
            'topProducts' => $topProducts,
            'chartLabels' => json_encode($chartLabels),
            'chartData' => json_encode($chartData),
            // Mới thêm
            'todayOrders' => $todayOrders,
            'todayRevenue' => $todayRevenue,
            'totalReviews' => $totalReviews,
            'avgAllRating' => $avgAllRating,
            'completionRate' => $completionRate,
            'completedOrders' => $completedOrders,
            'cancelledOrders' => $cancelledOrders,
            'totalSold' => $totalSold,
            'recentReviews' => $recentReviews,
            'orderStatusData' => json_encode(array_values($orderStatusData)),
        ]);
    }

    /* ================= REVENUE (THỐNG KÊ DOANH THU NÂNG CAO) ================= */
    public function revenue(Request $request){
        $period = $request->input('period', 'month'); // day, month, quarter, year
        $productId = $request->input('product_id', 'all');

        $query = OrderItem::select('order_items.*', 'orders.created_at as order_date')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.status', 'completed')
            ->with('phone');

        if ($productId !== 'all') {
            $query->where('order_items.phone_id', $productId);
        }

        // Sort newest first
        $orderItems = $query->orderBy('orders.created_at', 'desc')->get();

        $grouped = [];

        foreach ($orderItems as $item) {
            $date = \Carbon\Carbon::parse($item->order_date);
            $periodKey = '';
            $sortKey = '';
            
            if ($period == 'day') {
                $periodKey = $date->format('d/m/Y');
                $sortKey = $date->format('Y-m-d');
            } elseif ($period == 'month') {
                $periodKey = 'Tháng ' . $date->format('m/Y');
                $sortKey = $date->format('Y-m');
            } elseif ($period == 'quarter') {
                $quarter = ceil($date->format('n') / 3);
                $periodKey = 'Quý ' . $quarter . '/' . $date->format('Y');
                $sortKey = $date->format('Y') . '-' . $quarter;
            } elseif ($period == 'year') {
                $periodKey = 'Năm ' . $date->format('Y');
                $sortKey = $date->format('Y');
            }

            if (!isset($grouped[$sortKey])) {
                $grouped[$sortKey] = [
                    'period_name' => $periodKey,
                    'total_revenue' => 0,
                    'total_sold' => 0,
                    'products' => []
                ];
            }

            $revenue = $item->price * $item->quantity;
            $grouped[$sortKey]['total_revenue'] += $revenue;
            $grouped[$sortKey]['total_sold'] += $item->quantity;

            $phoneId = $item->phone_id;
            if (!isset($grouped[$sortKey]['products'][$phoneId])) {
                $grouped[$sortKey]['products'][$phoneId] = [
                    'id' => $phoneId,
                    'name' => $item->phone ? $item->phone->name : 'Sản phẩm đã xóa',
                    'image' => $item->phone ? $item->phone->image : null,
                    'quantity' => 0,
                    'revenue' => 0,
                ];
            }
            $grouped[$sortKey]['products'][$phoneId]['quantity'] += $item->quantity;
            $grouped[$sortKey]['products'][$phoneId]['revenue'] += $revenue;
        }

        // Sắp xếp theo sortKey giảm dần (mới nhất lên đầu)
        krsort($grouped);

        // Convert grouped products arrays to sorted arrays by revenue descending
        foreach ($grouped as &$group) {
            usort($group['products'], function($a, $b) {
                return $b['revenue'] <=> $a['revenue'];
            });
        }

        $stats = array_values($grouped);
        $phones = Phone::select('id', 'name')->get();

        return view('admin.revenue', compact('stats', 'period', 'productId', 'phones'));
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