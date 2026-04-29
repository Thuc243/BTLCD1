<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShipperController extends Controller
{
    /**
     * Hiển thị danh sách đơn hàng COD đang chờ giao
     */
    public function orders()
    {
        // Lấy các đơn hàng thanh toán COD và đang ở trạng thái pending (chờ giao)
        $orders = Order::with(['user', 'items.phone'])
            ->where('payment_method', 'COD')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('shipper.orders', compact('orders'));
    }

    /**
     * Xác nhận giao hàng thành công bằng hình ảnh
     */
    public function complete(Request $request, $id)
    {
        $request->validate([
            'delivery_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // Tối đa 5MB
        ]);

        $order = Order::findOrFail($id);

        if ($order->status !== 'pending' || $order->payment_method !== 'COD') {
            return back()->withErrors(['msg' => 'Đơn hàng không hợp lệ hoặc đã được xử lý.']);
        }

        $fileName = null;
        if ($request->hasFile('delivery_image')) {
            $file = $request->file('delivery_image');
            $fileName = 'delivery_' . time() . '_' . $order->id . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/delivery'), $fileName);
        }

        $order->update([
            'status' => 'completed',
            'delivery_image' => $fileName,
            'shipper_id' => Auth::id(),
        ]);

        return back()->with('success', 'Đã xác nhận giao hàng thành công!');
    }
}
