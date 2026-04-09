@extends('layout.admin')

@section('content')

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stats-card">
            <div class="stats-icon" style="background: rgba(59,130,246,0.1); color: var(--primary);">
                <i data-lucide="smartphone" size="22"></i>
            </div>
            <div class="stats-info">
                <h3>{{ $phones }}</h3>
                <span>Sản phẩm</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stats-card">
            <div class="stats-icon" style="background: rgba(16,185,129,0.1); color: var(--success);">
                <i data-lucide="shopping-bag" size="22"></i>
            </div>
            <div class="stats-info">
                <h3>{{ $orders }}</h3>
                <span>Đơn hàng</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stats-card">
            <div class="stats-icon" style="background: rgba(245,158,11,0.1); color: var(--warning);">
                <i data-lucide="users" size="22"></i>
            </div>
            <div class="stats-info">
                <h3>{{ $users }}</h3>
                <span>Người dùng</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stats-card">
            <div class="stats-icon" style="background: rgba(239,68,68,0.1); color: var(--danger);">
                <i data-lucide="trending-up" size="22"></i>
            </div>
            <div class="stats-info">
                <h3>{{ number_format($totalRevenue / 1000000, 1) }}M</h3>
                <span>Doanh thu (VNĐ)</span>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Revenue Chart -->
    <div class="col-lg-8">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0">📈 Doanh thu 7 ngày gần nhất</h6>
                <span class="badge bg-light text-muted border">VNĐ</span>
            </div>
            <canvas id="revenueChart" height="250"></canvas>
        </div>
    </div>

    <!-- Top Products -->
    <div class="col-lg-4">
        <div class="card p-4 h-100">
            <h6 class="fw-bold mb-3">🏆 Top sản phẩm bán chạy</h6>
            @foreach($topProducts as $i => $tp)
            <div class="d-flex align-items-center gap-3 mb-3 {{ !$loop->last ? 'pb-3 border-bottom' : '' }}">
                <div class="d-flex align-items-center justify-content-center rounded-circle fw-bold" 
                    style="width: 32px; height: 32px; background: {{ $i == 0 ? '#fef3c7' : ($i == 1 ? '#f1f5f9' : '#fff7ed') }}; 
                           color: {{ $i == 0 ? '#d97706' : ($i == 1 ? '#64748b' : '#ea580c') }}; font-size: 13px; flex-shrink: 0;">
                    {{ $i + 1 }}
                </div>
                <div class="flex-grow-1 min-w-0">
                    <div class="fw-semibold text-truncate" style="font-size: 13px;">{{ $tp->name }}</div>
                    <div class="text-muted" style="font-size: 11px;">Đã bán: {{ number_format($tp->sold) }}</div>
                </div>
                <div class="fw-bold text-nowrap" style="font-size: 13px; color: var(--primary);">
                    {{ number_format($tp->price / 1000000, 1) }}M
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="card">
    <div class="p-4 pb-0">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="fw-bold mb-0">📦 Đơn hàng gần đây</h6>
            <a href="{{ route('admin.orders') }}" class="text-primary text-decoration-none small fw-semibold">Xem tất cả →</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th class="ps-4">Mã ĐH</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Ngày đặt</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $o)
                <tr>
                    <td class="ps-4 fw-semibold">#ORD-{{ str_pad($o->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td>
                        <div class="fw-semibold">{{ $o->user->name ?? 'N/A' }}</div>
                    </td>
                    <td class="fw-bold" style="color: var(--primary);">{{ number_format($o->total, 0, ',', '.') }}₫</td>
                    <td>
                        @if($o->status == 'pending')
                            <span class="badge rounded-pill" style="background: #fef3c7; color: #d97706; border: 1px solid #fbbf24;">Đang chờ</span>
                        @elseif($o->status == 'completed')
                            <span class="badge rounded-pill" style="background: #d1fae5; color: #059669; border: 1px solid #34d399;">Hoàn tất</span>
                        @else
                            <span class="badge rounded-pill" style="background: #fee2e2; color: #dc2626; border: 1px solid #f87171;">Đã hủy</span>
                        @endif
                    </td>
                    <td class="text-muted" style="font-size: 13px;">{{ $o->created_at->format('H:i d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const ctx = document.getElementById('revenueChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! $chartLabels !!},
        datasets: [{
            label: 'Doanh thu (VNĐ)',
            data: {!! $chartData !!},
            borderColor: '#3b82f6',
            backgroundColor: 'rgba(59,130,246,0.08)',
            borderWidth: 3,
            tension: 0.4,
            fill: true,
            pointBackgroundColor: '#3b82f6',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 5,
            pointHoverRadius: 7
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false },
            tooltip: {
                callbacks: {
                    label: (ctx) => new Intl.NumberFormat('vi-VN', {style:'currency',currency:'VND'}).format(ctx.raw)
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: { color: '#f1f5f9' },
                ticks: {
                    callback: v => (v / 1000000).toFixed(0) + 'M',
                    font: { size: 11 }
                }
            },
            x: {
                grid: { display: false },
                ticks: { font: { size: 11 } }
            }
        }
    }
});
</script>

@endsection