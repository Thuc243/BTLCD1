@extends('layout.admin')

@section('content')

<!-- Stats Cards - Row 1: Tổng quan chính -->
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
                <span>Tổng doanh thu</span>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards - Row 2: Thống kê chi tiết -->
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stats-card" style="border-left: 4px solid var(--primary);">
            <div class="stats-info">
                <h3>{{ $todayOrders }}</h3>
                <span>Đơn hàng hôm nay</span>
            </div>
            <div class="ms-auto text-end">
                <div style="font-size: 12px; color: var(--primary); font-weight: 600;">
                    {{ number_format($todayRevenue / 1000000, 1) }}M₫
                </div>
                <div style="font-size: 11px; color: var(--text-muted);">Doanh thu hôm nay</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stats-card" style="border-left: 4px solid var(--warning);">
            <div class="stats-info">
                <h3>{{ $pendingOrders }}</h3>
                <span>Đang chờ xử lý</span>
            </div>
            <div class="ms-auto">
                <span class="badge rounded-pill" style="background: #fef3c7; color: #d97706; font-size: 11px;">
                    Cần xử lý
                </span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stats-card" style="border-left: 4px solid var(--success);">
            <div class="stats-info">
                <h3>{{ $totalReviews }}</h3>
                <span>Tổng đánh giá</span>
            </div>
            <div class="ms-auto text-end">
                <div style="font-size: 14px; color: #f59e0b; font-weight: 700;">
                    ⭐ {{ number_format($avgAllRating, 1) }}
                </div>
                <div style="font-size: 11px; color: var(--text-muted);">Trung bình</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stats-card" style="border-left: 4px solid #8b5cf6;">
            <div class="stats-info">
                <h3>{{ number_format($totalSold) }}</h3>
                <span>Sản phẩm đã bán</span>
            </div>
            <div class="ms-auto text-end">
                <div style="font-size: 14px; color: #10b981; font-weight: 700;">
                    {{ $completionRate }}%
                </div>
                <div style="font-size: 11px; color: var(--text-muted);">Tỷ lệ hoàn thành</div>
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

    <!-- Order Status Doughnut -->
    <div class="col-lg-4">
        <div class="card p-4 h-100">
            <h6 class="fw-bold mb-3">📊 Trạng thái đơn hàng</h6>
            <div style="max-width: 220px; margin: 0 auto;">
                <canvas id="orderStatusChart"></canvas>
            </div>
            <div class="mt-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 10px; height: 10px; border-radius: 50%; background: #f59e0b;"></div>
                        <span style="font-size: 13px;">Đang chờ</span>
                    </div>
                    <span class="fw-bold" style="font-size: 13px;">{{ $pendingOrders }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 10px; height: 10px; border-radius: 50%; background: #10b981;"></div>
                        <span style="font-size: 13px;">Hoàn thành</span>
                    </div>
                    <span class="fw-bold" style="font-size: 13px;">{{ $completedOrders }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 10px; height: 10px; border-radius: 50%; background: #ef4444;"></div>
                        <span style="font-size: 13px;">Đã hủy</span>
                    </div>
                    <span class="fw-bold" style="font-size: 13px;">{{ $cancelledOrders }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Top Products -->
    <div class="col-lg-6">
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

    <!-- Recent Reviews -->
    <div class="col-lg-6">
        <div class="card p-4 h-100">
            <h6 class="fw-bold mb-3">⭐ Đánh giá gần đây</h6>
            @forelse($recentReviews as $rv)
            <div class="d-flex gap-3 mb-3 {{ !$loop->last ? 'pb-3 border-bottom' : '' }}">
                <div class="d-flex align-items-center justify-content-center rounded-circle fw-bold flex-shrink-0" 
                     style="width: 36px; height: 36px; background: linear-gradient(135deg, #6366f1, #a78bfa); color: white; font-size: 13px;">
                    {{ strtoupper(substr($rv->user->name ?? 'U', 0, 1)) }}
                </div>
                <div class="flex-grow-1 min-w-0">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="fw-semibold" style="font-size: 13px;">{{ $rv->user->name ?? 'N/A' }}</span>
                            <div style="font-size: 11px; color: var(--text-muted);">{{ $rv->phone->name ?? 'Sản phẩm đã xóa' }}</div>
                        </div>
                        <div class="d-flex align-items-center gap-1 flex-shrink-0">
                            @for($i = 1; $i <= 5; $i++)
                                <i data-lucide="star" size="11" fill="{{ $i <= $rv->rating ? '#f59e0b' : '#e5e7eb' }}" stroke="none"></i>
                            @endfor
                        </div>
                    </div>
                    <p class="text-muted mb-0 mt-1 text-truncate" style="font-size: 12px;">{{ $rv->content }}</p>
                    <small class="text-muted" style="font-size: 10px;">{{ $rv->created_at->diffForHumans() }}</small>
                </div>
            </div>
            @empty
            <div class="text-center py-4 text-muted">
                <i data-lucide="message-circle" size="32" class="mb-2" style="color: #d1d5db;"></i>
                <p style="font-size: 13px;">Chưa có đánh giá nào</p>
            </div>
            @endforelse
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
// Revenue Line Chart
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

// Order Status Doughnut Chart
const ctx2 = document.getElementById('orderStatusChart').getContext('2d');
new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: ['Đang chờ', 'Hoàn thành', 'Đã hủy'],
        datasets: [{
            data: {!! $orderStatusData !!},
            backgroundColor: ['#f59e0b', '#10b981', '#ef4444'],
            borderWidth: 0,
            hoverOffset: 6
        }]
    },
    options: {
        responsive: true,
        cutout: '65%',
        plugins: {
            legend: { display: false },
            tooltip: {
                callbacks: {
                    label: (ctx) => ctx.label + ': ' + ctx.raw + ' đơn'
                }
            }
        }
    }
});
</script>

@endsection