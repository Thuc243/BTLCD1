@extends('layout.user')

@section('content')

<style>
    .checkout-title {
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .checkout-subtitle {
        color: var(--text-muted);
        font-size: 14px;
        margin-bottom: 28px;
    }

    .checkout-card {
        background: white;
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        padding: 28px;
        margin-bottom: 20px;
    }

    .checkout-card-title {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 14px;
        border-bottom: 2px solid var(--border-light);
    }

    .checkout-card-title .num {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: var(--primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
    }

    .form-label-custom {
        font-weight: 600;
        font-size: 13px;
        color: var(--text-dark);
        margin-bottom: 6px;
    }

    .form-control-custom {
        height: 46px;
        border: 2px solid var(--border-light);
        border-radius: var(--radius-sm);
        padding: 0 16px;
        font-size: 14px;
        font-family: inherit;
        transition: var(--transition);
    }

    .form-control-custom:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 4px rgba(233,69,96,0.1);
        outline: none;
    }

    textarea.form-control-custom {
        height: auto;
        padding: 14px 16px;
    }

    /* Payment methods */
    .payment-options {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .payment-option {
        flex: 1;
        min-width: 200px;
    }

    .payment-option input[type="radio"] { display: none; }

    .payment-label {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px 20px;
        border: 2px solid var(--border-light);
        border-radius: var(--radius-sm);
        cursor: pointer;
        transition: var(--transition);
    }

    .payment-option input:checked + .payment-label {
        border-color: var(--accent);
        background: rgba(233,69,96,0.04);
    }

    .payment-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .payment-name {
        font-weight: 700;
        font-size: 14px;
    }

    .payment-desc {
        font-size: 12px;
        color: var(--text-muted);
    }

    /* QR Section */
    .qr-section {
        display: none;
        margin-top: 20px;
        padding: 24px;
        background: linear-gradient(135deg, #f0f9ff, #eff6ff);
        border-radius: var(--radius-sm);
        border: 1px solid #bfdbfe;
        text-align: center;
    }

    .qr-section.show { display: block; }

    .qr-section img {
        border-radius: 12px;
        box-shadow: var(--shadow-md);
        margin: 12px 0;
    }

    .qr-info {
        font-size: 13px;
        color: #1e40af;
        font-weight: 600;
    }

    /* Order Summary */
    .order-summary-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid var(--border-light);
    }

    .order-summary-item:last-child { border-bottom: none; }

    .order-summary-item img {
        width: 50px;
        height: 50px;
        object-fit: contain;
        border-radius: 8px;
        background: var(--bg-body);
        padding: 4px;
    }

    .order-summary-item .name {
        font-weight: 600;
        font-size: 13px;
        flex: 1;
    }

    .order-summary-item .qty {
        font-size: 12px;
        color: var(--text-muted);
    }

    .order-summary-item .price {
        font-weight: 700;
        font-size: 14px;
        white-space: nowrap;
    }

    .checkout-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 22px;
        font-weight: 800;
        padding-top: 16px;
        margin-top: 8px;
        border-top: 2px solid var(--border-light);
    }

    .checkout-total .value { color: var(--accent); }

    .btn-order {
        width: 100%;
        height: 52px;
        border: none;
        border-radius: var(--radius-sm);
        background: linear-gradient(135deg, var(--accent), var(--accent-light));
        color: white;
        font-weight: 700;
        font-size: 16px;
        font-family: inherit;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: var(--transition);
        margin-top: 20px;
    }

    .btn-order:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(233,69,96,0.35);
    }

    /* ═══════ CHECKOUT MOBILE ═══════ */
    @media (max-width: 768px) {
        .payment-options { flex-direction: column; }
        .checkout-title { font-size: 20px; }
        .checkout-subtitle { font-size: 13px; margin-bottom: 20px; }
        .checkout-card { padding: 20px; margin-bottom: 14px; }
        .checkout-card-title { font-size: 14px; margin-bottom: 16px; padding-bottom: 10px; }
        .checkout-card-title .num { width: 24px; height: 24px; font-size: 11px; }
        .form-label-custom { font-size: 12px; }
        .form-control-custom { height: 42px; font-size: 13px; border-radius: 8px; }

        .payment-label { padding: 12px 14px; gap: 10px; }
        .payment-icon { width: 38px; height: 38px; border-radius: 8px; }
        .payment-name { font-size: 13px; }
        .payment-desc { font-size: 11px; }

        .qr-section { padding: 16px; }
        .qr-section img { width: 180px; }
        .qr-info { font-size: 12px; }

        .order-summary-item { gap: 10px; padding: 10px 0; }
        .order-summary-item img { width: 44px; height: 44px; }
        .order-summary-item .name { font-size: 12px; }
        .order-summary-item .price { font-size: 13px; }

        .checkout-total { font-size: 18px; }
        .btn-order { height: 48px; font-size: 14px; }
    }

    @media (max-width: 480px) {
        .checkout-title { font-size: 18px; }
        .checkout-card { padding: 16px; }
        .checkout-total { font-size: 16px; }
    }
</style>

<h2 class="checkout-title">
    <i data-lucide="credit-card" size="24"></i> Thanh toán
</h2>
<p class="checkout-subtitle">Vui lòng điền đầy đủ thông tin để hoàn tất đơn hàng.</p>

@if($errors->any())
    <div class="alert alert-danger border-0 mb-4" style="border-radius: var(--radius-sm);">
        <ul class="mb-0 ps-3">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('order') }}">
    @csrf

    <div class="row">
        <div class="col-lg-7">
            <!-- Thông tin giao hàng -->
            <div class="checkout-card">
                <h5 class="checkout-card-title">
                    <span class="num">1</span> Thông tin giao hàng
                </h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label-custom">Họ và tên người nhận *</label>
                        <input type="text" name="customer_name" class="form-control form-control-custom" 
                               placeholder="Nguyễn Văn A" required value="{{ old('customer_name', auth()->user()->name) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label-custom">Số điện thoại *</label>
                        <input type="text" name="phone_number" class="form-control form-control-custom" 
                               placeholder="0901 234 567" required value="{{ old('phone_number') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label-custom">Địa chỉ giao hàng *</label>
                    <textarea name="address" class="form-control form-control-custom" rows="3" 
                              placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành phố" required>{{ old('address') }}</textarea>
                </div>
            </div>

            <!-- Phương thức thanh toán -->
            <div class="checkout-card">
                <h5 class="checkout-card-title">
                    <span class="num">2</span> Phương thức thanh toán
                </h5>

                <div class="payment-options">
                    <div class="payment-option">
                        <input type="radio" id="cod" name="payment" value="COD" checked>
                        <label for="cod" class="payment-label">
                            <div class="payment-icon" style="background: #fef3c7; color: #d97706;">
                                <i data-lucide="truck" size="22"></i>
                            </div>
                            <div>
                                <div class="payment-name">Thanh toán khi nhận hàng</div>
                                <div class="payment-desc">COD - Trả tiền mặt khi nhận</div>
                            </div>
                        </label>
                    </div>

                    <div class="payment-option">
                        <input type="radio" id="qr" name="payment" value="QR">
                        <label for="qr" class="payment-label">
                            <div class="payment-icon" style="background: #dbeafe; color: #2563eb;">
                                <i data-lucide="qr-code" size="22"></i>
                            </div>
                            <div>
                                <div class="payment-name">Chuyển khoản ngân hàng</div>
                                <div class="payment-desc">Quét mã QR để thanh toán</div>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="qr-section" id="qrSection">
                    <h6 style="font-weight: 700; margin-bottom: 8px;">Quét mã QR để thanh toán</h6>
                    <img src="https://img.vietqr.io/image/970422-0337312919-compact2.png?amount={{ $total }}&addInfo=Thanh%20toan%20don%20hang%20Phone%20Shop&accountName=MAI%20ANH%20THUC" 
                         width="220" alt="QR Code">
                    <div class="qr-info mt-2">
                        <p class="mb-1">🏦 MB Bank - STK: 0337312919</p>
                        <p class="mb-1">👤 MAI ANH THUC</p>
                        <p class="mb-0">💰 Số tiền: <strong>{{ number_format($total, 0, ',', '.') }}₫</strong></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="checkout-card" style="position: sticky; top: 100px;">
                <h5 class="checkout-card-title">
                    <span class="num">3</span> Đơn hàng của bạn
                </h5>

                @foreach($cart as $id => $item)
                <div class="order-summary-item">
                    @php $coImg = str_starts_with($item['image'] ?? '', 'http') ? $item['image'] : asset('uploads/' . $item['image']); @endphp
                    <img src="{{ $coImg }}" alt="{{ $item['name'] }}"
                        onerror="this.src='https://placehold.co/50x50/f0f0f0/999?text=Phone'">
                    <div class="name">
                        {{ $item['name'] }}
                        <div class="qty">x{{ $item['qty'] }}</div>
                    </div>
                    <div class="price">{{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}₫</div>
                </div>
                @endforeach

                <div class="d-flex justify-content-between mt-3 mb-2" style="font-size: 14px;">
                    <span>Tạm tính</span>
                    <span>{{ number_format($total, 0, ',', '.') }}₫</span>
                </div>
                <div class="d-flex justify-content-between mb-2" style="font-size: 14px;">
                    <span>Phí vận chuyển</span>
                    <span style="color: #10b981; font-weight: 600;">Miễn phí</span>
                </div>

                <div class="checkout-total">
                    <span>Tổng cộng</span>
                    <span class="value">{{ number_format($total, 0, ',', '.') }}₫</span>
                </div>

                <button type="submit" class="btn-order">
                    <i data-lucide="check-circle" size="20"></i>
                    ĐẶT HÀNG NGAY
                </button>

                <div class="text-center mt-3">
                    <a href="{{ route('cart') }}" style="color: var(--text-muted); font-size: 13px; text-decoration: none;">
                        <i data-lucide="arrow-left" size="14"></i> Quay lại giỏ hàng
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const radios = document.querySelectorAll('input[name="payment"]');
    const qrSection = document.getElementById('qrSection');
    
    radios.forEach(r => {
        r.addEventListener('change', function() {
            if (this.value === 'QR') {
                qrSection.classList.add('show');
            } else {
                qrSection.classList.remove('show');
            }
        });
    });
});
</script>

@endsection