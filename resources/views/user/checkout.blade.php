@extends('layout.user')

@section('content')

<h3>💳 Thanh toán</h3>

<div class="row">
    <div class="col-md-8">
        <form method="POST" action="/order" class="p-4 border rounded bg-white">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Họ tên</label>
                <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Địa chỉ</label>
                <input type="text" name="address" class="form-control" placeholder="Nhập địa chỉ giao hàng" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Số điện thoại</label>
                <input type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phương thức thanh toán</label>
                <select name="payment" class="form-select" required>
                    <option value="">-- Chọn phương thức --</option>
                    <option value="credit_card">Thẻ tín dụng</option>
                    <option value="bank_transfer">Chuyển khoản</option>
                    <option value="cod">Thanh toán khi nhận hàng</option>
                </select>
            </div>

            <button class="btn btn-success w-100" type="submit">✅ Xác nhận thanh toán</button>
        </form>
    </div>

    <div class="col-md-4">
        <div class="p-4 border rounded bg-white">
            <h5>📋 Tóm tắt đơn hàng</h5>

            @php $total = 0; @endphp

            @foreach(session('cart',[]) as $item)
            <div class="d-flex justify-content-between mb-2">
                <span>{{ $item['name'] }} x{{ $item['qty'] }}</span>
                <span>{{ number_format($item['price'] * $item['qty']) }} VND</span>
            </div>
            @php $total += $item['price'] * $item['qty']; @endphp
            @endforeach

            <hr>

            <div class="d-flex justify-content-between">
                <strong>Tổng cộng:</strong>
                <strong class="text-danger">{{ number_format($total) }} VND</strong>
            </div>
        </div>
    </div>
</div>

@endsection
