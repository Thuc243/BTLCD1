@extends('layout.user')

@section('content')

<style>
    .cart-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
    }

    .cart-title {
        font-size: 24px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .cart-count-label {
        font-size: 14px;
        color: var(--text-muted);
        font-weight: 500;
    }

    .cart-table {
        background: white;
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }

    .cart-table table {
        margin-bottom: 0;
    }

    .cart-table thead { background: var(--bg-body); }

    .cart-table th {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-muted);
        padding: 14px 20px;
        border: none;
    }

    .cart-table td {
        padding: 16px 20px;
        vertical-align: middle;
        border-color: var(--border-light);
    }

    .cart-product {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .cart-product img {
        width: 64px;
        height: 64px;
        object-fit: contain;
        border-radius: 10px;
        background: var(--bg-body);
        padding: 6px;
    }

    .cart-product-name {
        font-weight: 600;
        font-size: 14px;
        color: var(--text-dark);
    }

    .cart-price {
        font-weight: 700;
        font-size: 15px;
        color: var(--text-dark);
    }

    .qty-mini {
        display: flex;
        align-items: center;
        gap: 0;
    }

    .qty-mini-btn {
        width: 32px;
        height: 32px;
        border: 1px solid var(--border-light);
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-weight: 700;
        font-size: 14px;
        transition: var(--transition);
        text-decoration: none;
        color: var(--text-dark);
    }

    .qty-mini-btn:first-child { border-radius: 6px 0 0 6px; }
    .qty-mini-btn:last-child { border-radius: 0 6px 6px 0; }
    .qty-mini-btn:hover { background: var(--bg-body); }

    .qty-mini-val {
        width: 40px;
        height: 32px;
        border: 1px solid var(--border-light);
        border-left: none;
        border-right: none;
        text-align: center;
        font-weight: 700;
        font-size: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
    }

    .cart-subtotal {
        font-weight: 800;
        font-size: 15px;
        color: var(--accent);
    }

    .btn-remove {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        border: 1px solid #fecaca;
        background: #fef2f2;
        color: #ef4444;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        text-decoration: none;
    }

    .btn-remove:hover {
        background: #ef4444;
        color: white;
        border-color: #ef4444;
    }

    /* Summary Card */
    .summary-card {
        background: white;
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        padding: 28px;
        position: sticky;
        top: 100px;
    }

    .summary-title {
        font-size: 18px;
        font-weight: 800;
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 2px solid var(--border-light);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        font-size: 14px;
    }

    .summary-row.total {
        font-size: 20px;
        font-weight: 800;
        margin-top: 16px;
        padding-top: 16px;
        border-top: 2px solid var(--border-light);
    }

    .summary-row.total .value { color: var(--accent); }

    .btn-checkout {
        width: 100%;
        height: 52px;
        border: none;
        border-radius: var(--radius-sm);
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        font-weight: 700;
        font-size: 15px;
        font-family: inherit;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: var(--transition);
        text-decoration: none;
        margin-top: 20px;
    }

    .btn-checkout:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(26,26,46,0.3);
        color: white;
    }

    .btn-checkout.disabled {
        opacity: 0.5;
        pointer-events: none;
    }

    .continue-shopping {
        text-align: center;
        margin-top: 16px;
    }

    .continue-shopping a {
        color: var(--text-muted);
        text-decoration: none;
        font-size: 13px;
        font-weight: 500;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .continue-shopping a:hover { color: var(--primary); }

    /* Empty Cart */
    .cart-empty {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
    }

    .cart-empty-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: var(--bg-body);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: var(--text-muted);
    }

    /* ═══════ CART MOBILE ═══════ */
    @media (max-width: 768px) {
        .cart-title { font-size: 20px; }
        .cart-count-label { font-size: 13px; }

        /* Hide table headers on mobile */
        .cart-table thead { display: none; }
        .cart-table table { border: none; }
        .cart-table td { 
            display: block; 
            padding: 8px 16px; 
            border: none;
            text-align: left;
        }
        .cart-table tr {
            display: block;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-light);
            position: relative;
        }
        .cart-table tr:last-child { border-bottom: none; }

        /* Product info row */
        .cart-product { margin-bottom: 8px; }
        .cart-product img { width: 52px; height: 52px; }
        .cart-product-name { font-size: 13px; }

        /* Price + Qty + Subtotal inline on mobile */
        .cart-table td:nth-child(2) { 
            display: inline-block; 
            font-size: 13px;
            padding: 4px 16px;
            color: var(--text-muted);
        }
        .cart-table td:nth-child(2)::before {
            content: "Đơn giá: ";
            font-weight: 400;
            color: var(--text-muted);
        }

        .cart-table td:nth-child(3) { 
            display: inline-block;
            padding: 8px 16px;
        }

        .cart-table td:nth-child(4) {
            display: inline-block;
            padding: 4px 16px;
            font-size: 15px;
        }

        /* Remove button - positioned top right */
        .cart-table td:nth-child(5) {
            position: absolute;
            top: 12px;
            right: 0;
            padding: 0 16px;
        }

        .qty-mini-btn { width: 30px; height: 30px; }
        .qty-mini-val { width: 36px; height: 30px; font-size: 12px; }

        /* Summary card */
        .summary-card { position: static; padding: 20px; margin-top: 16px; }
        .summary-title { font-size: 16px; }
        .summary-row.total { font-size: 18px; }
        .btn-checkout { height: 48px; font-size: 14px; }
    }

    @media (max-width: 480px) {
        .cart-title { font-size: 18px; }
        .cart-product img { width: 44px; height: 44px; }
        .cart-product-name { font-size: 12px; }
    }
</style>

<div class="cart-header">
    <div>
        <h2 class="cart-title">
            <i data-lucide="shopping-bag" size="24"></i> Giỏ hàng
        </h2>
        <span class="cart-count-label">{{ count($cart) }} sản phẩm</span>
    </div>
</div>

@if(count($cart) > 0)
<div class="row">
    <div class="col-lg-8">
        <div class="cart-table">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Đơn giá</th>
                            <th style="width: 130px;">Số lượng</th>
                            <th>Thành tiền</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($cart as $id => $item)
                            @php $subtotal = $item['price'] * $item['qty']; $total += $subtotal; @endphp
                            <tr>
                                <td>
                                    <div class="cart-product">
                                        @php $cartImg = str_starts_with($item['image'] ?? '', 'http') ? $item['image'] : asset('uploads/' . $item['image']); @endphp
                                        <img src="{{ $cartImg }}" alt="{{ $item['name'] }}"
                                            onerror="this.src='https://placehold.co/64x64/f0f0f0/999?text=Phone'">
                                        <span class="cart-product-name">{{ $item['name'] }}</span>
                                    </div>
                                </td>
                                <td class="cart-price">{{ number_format($item['price'], 0, ',', '.') }}₫</td>
                                <td>
                                    <div class="qty-mini">
                                        <form action="{{ route('cart.update', $id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="qty" value="{{ max(1, $item['qty'] - 1) }}">
                                            <button type="submit" class="qty-mini-btn">−</button>
                                        </form>
                                        <div class="qty-mini-val">{{ $item['qty'] }}</div>
                                        <form action="{{ route('cart.update', $id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="qty" value="{{ $item['qty'] + 1 }}">
                                            <button type="submit" class="qty-mini-btn">+</button>
                                        </form>
                                    </div>
                                </td>
                                <td class="cart-subtotal">{{ number_format($subtotal, 0, ',', '.') }}₫</td>
                                <td>
                                    <a href="{{ route('remove', $id) }}" class="btn-remove" title="Xóa">
                                        <i data-lucide="trash-2" size="15"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="summary-card">
            <h5 class="summary-title">Tóm tắt đơn hàng</h5>
            
            <div class="summary-row">
                <span>Tạm tính ({{ count($cart) }} sản phẩm)</span>
                <span>{{ number_format($total, 0, ',', '.') }}₫</span>
            </div>
            <div class="summary-row">
                <span>Phí vận chuyển</span>
                <span style="color: #10b981; font-weight: 600;">Miễn phí</span>
            </div>
            <div class="summary-row total">
                <span>Tổng cộng</span>
                <span class="value">{{ number_format($total, 0, ',', '.') }}₫</span>
            </div>

            <a href="{{ route('checkout') }}" class="btn-checkout">
                <i data-lucide="credit-card" size="18"></i>
                Tiến hành thanh toán
            </a>

            <div class="continue-shopping">
                <a href="{{ route('home') }}">
                    <i data-lucide="arrow-left" size="14"></i>
                    Tiếp tục mua sắm
                </a>
            </div>
        </div>
    </div>
</div>
@else
<div class="cart-empty">
    <div class="cart-empty-icon">
        <i data-lucide="shopping-bag" size="36"></i>
    </div>
    <h5 style="font-weight: 700; margin-bottom: 8px;">Giỏ hàng trống</h5>
    <p class="text-muted mb-4">Bạn chưa thêm sản phẩm nào vào giỏ hàng.</p>
    <a href="{{ route('home') }}" class="btn-checkout" style="max-width: 250px; margin: 0 auto;">
        <i data-lucide="store" size="18"></i>
        Mua sắm ngay
    </a>
</div>
@endif

@endsection