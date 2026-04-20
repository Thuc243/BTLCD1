@extends('layout.user')

@section('content')

<style>
    .orders-title {
        font-size: 24px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 8px;
    }

    .orders-subtitle {
        color: var(--text-muted);
        font-size: 14px;
        margin-bottom: 28px;
    }

    .order-card {
        background: white;
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        margin-bottom: 16px;
        overflow: hidden;
        transition: var(--transition);
    }

    .order-card:hover {
        box-shadow: var(--shadow-md);
    }

    .order-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 24px;
        background: var(--bg-body);
        border-bottom: 1px solid var(--border-light);
        flex-wrap: wrap;
        gap: 10px;
    }

    .order-id {
        font-weight: 700;
        font-size: 15px;
        color: var(--text-dark);
    }

    .order-date {
        font-size: 13px;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .order-status {
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pending {
        background: #fef3c7;
        color: #d97706;
        border: 1px solid #fbbf24;
    }

    .status-completed {
        background: #d1fae5;
        color: #059669;
        border: 1px solid #34d399;
    }

    .status-cancelled {
        background: #fee2e2;
        color: #dc2626;
        border: 1px solid #f87171;
    }

    .order-body { padding: 20px 24px; }

    .order-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 10px 0;
        border-bottom: 1px solid var(--border-light);
    }

    .order-item:last-child { border-bottom: none; }

    .order-item img {
        width: 56px;
        height: 56px;
        object-fit: contain;
        border-radius: 10px;
        background: var(--bg-body);
        padding: 4px;
    }

    .order-item-info {
        flex: 1;
    }

    .order-item-name {
        font-weight: 600;
        font-size: 14px;
        color: var(--text-dark);
    }

    .order-item-qty {
        font-size: 12px;
        color: var(--text-muted);
    }

    .order-item-price {
        font-weight: 700;
        font-size: 14px;
        color: var(--accent);
        white-space: nowrap;
    }

    .order-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 24px;
        background: var(--bg-body);
        border-top: 1px solid var(--border-light);
        flex-wrap: wrap;
        gap: 10px;
    }

    .order-payment {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: var(--text-muted);
    }

    .order-total {
        font-size: 18px;
        font-weight: 800;
        color: var(--accent);
    }

    .order-shipping {
        font-size: 12px;
        color: var(--text-muted);
        margin-top: 4px;
    }

    /* Timeline */
    .order-timeline {
        display: flex;
        align-items: center;
        gap: 0;
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px dashed var(--border-light);
    }

    .timeline-step {
        flex: 1;
        text-align: center;
        position: relative;
    }

    .timeline-step::after {
        content: '';
        position: absolute;
        top: 15px;
        left: 50%;
        width: 100%;
        height: 2px;
        background: var(--border-light);
        z-index: 0;
    }

    .timeline-step:last-child::after { display: none; }

    .timeline-dot {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: var(--border-light);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 8px;
        position: relative;
        z-index: 1;
        color: var(--text-muted);
    }

    .timeline-dot.active {
        background: #10b981;
        color: white;
    }

    .timeline-dot.cancelled {
        background: #ef4444;
        color: white;
    }

    .timeline-label {
        font-size: 11px;
        font-weight: 600;
        color: var(--text-muted);
    }

    .timeline-label.active { color: #10b981; }
    .timeline-label.cancelled { color: #ef4444; }

    /* Empty State */
    .orders-empty {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
    }

    .orders-empty-icon {
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

    /* ═══════ ORDERS MOBILE ═══════ */
    @media (max-width: 768px) {
        .orders-title { font-size: 20px; }
        .orders-subtitle { font-size: 13px; margin-bottom: 20px; }

        .order-header { padding: 14px 16px; }
        .order-id { font-size: 13px; }
        .order-date { font-size: 11px; }
        .order-status { font-size: 10px; padding: 4px 10px; }

        .order-body { padding: 14px 16px; }
        .order-item { gap: 10px; padding: 8px 0; }
        .order-item img { width: 44px; height: 44px; border-radius: 8px; }
        .order-item-name { font-size: 13px; }
        .order-item-qty { font-size: 11px; }
        .order-item-price { font-size: 13px; }

        .order-footer { padding: 12px 16px; }
        .order-payment { font-size: 12px; }
        .order-shipping { font-size: 11px; }
        .order-total { font-size: 16px; }

        /* Timeline mobile */
        .order-timeline { margin-top: 12px; padding-top: 12px; }
        .timeline-dot { width: 26px; height: 26px; }
        .timeline-label { font-size: 10px; }
        .timeline-step::after { top: 12px; }
    }

    @media (max-width: 480px) {
        .orders-title { font-size: 18px; }
        .order-item img { width: 38px; height: 38px; }
        .order-item-name { font-size: 12px; }
        .order-total { font-size: 15px; }
    }
</style>

<h2 class="orders-title">
    <i data-lucide="package" size="24"></i> Đơn hàng của tôi
</h2>
<p class="orders-subtitle">Theo dõi trạng thái các đơn hàng đã đặt.</p>

@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: var(--radius-sm);">
        <i data-lucide="check-circle" size="18" class="me-2"></i>
        {{ session('success') }}
    </div>
@endif

@if($orders->count())
    @foreach($orders as $o)
    <div class="order-card">
        <div class="order-header">
            <div>
                <div class="order-id">#ORD-{{ str_pad($o->id, 5, '0', STR_PAD_LEFT) }}</div>
                <div class="order-date">
                    <i data-lucide="calendar" size="13"></i>
                    {{ $o->created_at->format('d/m/Y - H:i') }}
                </div>
            </div>
            <span class="order-status status-{{ $o->status }}">
                @if($o->status == 'pending') ⏳ Đang xử lý
                @elseif($o->status == 'completed') ✅ Hoàn thành
                @else ❌ Đã hủy
                @endif
            </span>
        </div>

        <div class="order-body">
            @foreach($o->items as $item)
            <div class="order-item">
                @php $ordImg = str_starts_with($item->phone->image ?? '', 'http') ? $item->phone->image : asset('uploads/' . ($item->phone->image ?? '')); @endphp
                <img src="{{ $ordImg }}" alt=""
                    onerror="this.src='https://placehold.co/56x56/f0f0f0/999?text=Phone'">
                <div class="order-item-info">
                    <div class="order-item-name">{{ $item->phone->name ?? 'Sản phẩm đã xóa' }}</div>
                    <div class="order-item-qty">Số lượng: {{ $item->quantity }} × {{ number_format($item->price, 0, ',', '.') }}₫</div>
                </div>
                <div class="order-item-price">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}₫</div>
            </div>
            @endforeach

            <!-- Timeline -->
            <div class="order-timeline">
                <div class="timeline-step">
                    <div class="timeline-dot active"><i data-lucide="check" size="14"></i></div>
                    <div class="timeline-label active">Đã đặt</div>
                </div>
                <div class="timeline-step">
                    <div class="timeline-dot {{ $o->status == 'cancelled' ? 'cancelled' : ($o->status == 'completed' ? 'active' : '') }}">
                        @if($o->status == 'cancelled')
                            <i data-lucide="x" size="14"></i>
                        @elseif($o->status == 'completed')
                            <i data-lucide="check" size="14"></i>
                        @else
                            <i data-lucide="clock" size="14"></i>
                        @endif
                    </div>
                    <div class="timeline-label {{ $o->status == 'cancelled' ? 'cancelled' : ($o->status == 'completed' ? 'active' : '') }}">
                        {{ $o->status == 'cancelled' ? 'Đã hủy' : 'Xử lý' }}
                    </div>
                </div>
                <div class="timeline-step">
                    <div class="timeline-dot {{ $o->status == 'completed' ? 'active' : '' }}">
                        <i data-lucide="{{ $o->status == 'completed' ? 'check' : 'package' }}" size="14"></i>
                    </div>
                    <div class="timeline-label {{ $o->status == 'completed' ? 'active' : '' }}">Giao hàng</div>
                </div>
                <div class="timeline-step">
                    <div class="timeline-dot {{ $o->status == 'completed' ? 'active' : '' }}">
                        <i data-lucide="{{ $o->status == 'completed' ? 'check' : 'flag' }}" size="14"></i>
                    </div>
                    <div class="timeline-label {{ $o->status == 'completed' ? 'active' : '' }}">Hoàn tất</div>
                </div>
            </div>
        </div>

        <div class="order-footer">
            <div>
                <div class="order-payment">
                    <i data-lucide="credit-card" size="14"></i>
                    {{ $o->payment_method == 'COD' ? 'Thanh toán khi nhận hàng' : 'Chuyển khoản QR' }}
                </div>
                @if($o->address)
                <div class="order-shipping">
                    <i data-lucide="map-pin" size="12"></i> {{ $o->address }}
                </div>
                @endif
            </div>
            <div class="text-end">
                <div class="order-total">{{ number_format($o->total, 0, ',', '.') }}₫</div>
            </div>
        </div>
    </div>
    @endforeach
@else
    <div class="orders-empty">
        <div class="orders-empty-icon">
            <i data-lucide="package" size="36"></i>
        </div>
        <h5 style="font-weight: 700; margin-bottom: 8px;">Chưa có đơn hàng nào</h5>
        <p class="text-muted mb-4">Hãy mua sắm để tạo đơn hàng đầu tiên!</p>
        <a href="{{ route('home') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 28px; background: var(--primary); color: white; border-radius: 50px; font-weight: 700; text-decoration: none;">
            <i data-lucide="store" size="18"></i> Mua sắm ngay
        </a>
    </div>
@endif

@endsection