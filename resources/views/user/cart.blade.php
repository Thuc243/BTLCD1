@extends('layout.user')

@section('content')

<h3 class="section-title mb-4">
    <i data-lucide="shopping-cart"></i> GIỎ HÀNG CỦA BẠN
</h3>

<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm overflow-hidden">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Sản phẩm</th>
                        <th>Giá</th>
                        <th style="width: 120px;">Số lượng</th>
                        <th>Thành tiền</th>
                        <th class="text-end pe-4">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @forelse($cart as $id => $item)
                        @php $subtotal = $item['price'] * $item['qty']; $total += $subtotal; @endphp
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ asset('uploads/' . $item['image']) }}" width="60" class="rounded border">
                                    <span class="fw-bold">{{ $item['name'] }}</span>
                                </div>
                            </td>
                            <td>{{ number_format($item['price'], 0, ',', '.') }}đ</td>
                            <td>
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex align-items-center gap-2">
                                    @csrf
                                    <input type="number" name="qty" value="{{ $item['qty'] }}" class="form-control form-control-sm text-center" min="1" onchange="this.form.submit()">
                                </form>
                            </td>
                            <td class="fw-bold text-primary">{{ number_format($subtotal, 0, ',', '.') }}đ</td>
                            <td class="text-end pe-4">
                                <a href="{{ route('remove', $id) }}" class="btn btn-outline-danger btn-sm rounded-circle">
                                    <i data-lucide="trash-2" size="16"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted mb-3">
                                    <i data-lucide="shopping-bag" size="48"></i>
                                </div>
                                <p>Giỏ hàng của bạn đang trống.</p>
                                <a href="{{ route('home') }}" class="btn btn-primary rounded-pill px-4">Mua sắm ngay</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4">
            <h5 class="fw-bold mb-4">Tóm tắt đơn hàng</h5>
            <div class="d-flex justify-content-between mb-2">
                <span>Tạm tính:</span>
                <span>{{ number_format($total ?? 0, 0, ',', '.') }}đ</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span>Phí vận chuyển:</span>
                <span class="text-success">Miễn phí</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between mb-4">
                <span class="fw-bold h5">Tổng cộng:</span>
                <span class="fw-bold h5 text-danger">{{ number_format($total ?? 0, 0, ',', '.') }}đ</span>
            </div>
            
            <a href="{{ route('checkout') }}" class="btn btn-primary w-100 py-3 rounded-pill fw-bold {{ empty($cart) ? 'disabled' : '' }}">
                TIẾN HÀNH THANH TOÁN
            </a>
            
            <div class="mt-3 text-center">
                <a href="{{ route('home') }}" class="text-secondary text-decoration-none small">
                    <i data-lucide="arrow-left" size="14"></i> Tiếp tục mua hàng
                </a>
            </div>
        </div>
    </div>
</div>

@endsection