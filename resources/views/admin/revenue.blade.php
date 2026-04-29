@extends('layout.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i data-lucide="bar-chart-2" class="me-2 text-primary"></i> Báo cáo doanh thu chi tiết</h4>
</div>

<!-- Form Lọc -->
<div class="card p-4 mb-4">
    <form method="GET" action="{{ route('admin.revenue') }}" class="row g-3">
        <div class="col-md-4">
            <label class="form-label fw-semibold">Thời gian (Chu kỳ)</label>
            <select name="period" class="form-select" onchange="this.form.submit()">
                <option value="day" {{ $period == 'day' ? 'selected' : '' }}>Theo Ngày</option>
                <option value="month" {{ $period == 'month' ? 'selected' : '' }}>Theo Tháng</option>
                <option value="quarter" {{ $period == 'quarter' ? 'selected' : '' }}>Theo Quý</option>
                <option value="year" {{ $period == 'year' ? 'selected' : '' }}>Theo Năm</option>
            </select>
        </div>
        <div class="col-md-5">
            <label class="form-label fw-semibold">Sản phẩm</label>
            <select name="product_id" class="form-select" onchange="this.form.submit()">
                <option value="all" {{ $productId == 'all' ? 'selected' : '' }}>Tất cả sản phẩm</option>
                @foreach($phones as $p)
                    <option value="{{ $p->id }}" {{ $productId == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100 fw-semibold">
                <i data-lucide="filter" size="18" class="me-2"></i> Lọc dữ liệu
            </button>
        </div>
    </form>
</div>

<!-- Kết quả thống kê -->
<div class="card p-0 overflow-hidden">
    @if(count($stats) > 0)
        <div class="accordion" id="revenueAccordion">
            @foreach($stats as $index => $group)
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header" id="heading{{ $index }}">
                        <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}" style="background: #f8fafc; font-weight: 600;">
                            <div class="d-flex justify-content-between align-items-center w-100 me-3">
                                <span class="text-dark" style="font-size: 16px;">{{ $group['period_name'] }}</span>
                                <div class="d-flex gap-4 text-end">
                                    <div>
                                        <div style="font-size: 11px; color: var(--text-muted); text-transform: uppercase;">Số lượng bán</div>
                                        <div class="fw-bold" style="color: var(--primary);">{{ number_format($group['total_sold']) }}</div>
                                    </div>
                                    <div>
                                        <div style="font-size: 11px; color: var(--text-muted); text-transform: uppercase;">Tổng doanh thu</div>
                                        <div class="fw-bold" style="color: var(--success); font-size: 16px;">{{ number_format($group['total_revenue'], 0, ',', '.') }}₫</div>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#revenueAccordion">
                        <div class="accordion-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0 align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="ps-4" style="width: 60px;">#</th>
                                            <th>Sản phẩm</th>
                                            <th class="text-center">Số lượng</th>
                                            <th class="text-end pe-4">Doanh thu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($group['products'] as $i => $item)
                                            <tr>
                                                <td class="ps-4 fw-semibold text-muted">{{ $i + 1 }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-3">
                                                        @if($item['image'])
                                                            <img src="{{ str_starts_with($item['image'], 'http') ? $item['image'] : asset('uploads/' . $item['image']) }}" alt="" style="width: 40px; height: 40px; object-fit: contain; border-radius: 8px; background: #f1f5f9; padding: 2px;">
                                                        @else
                                                            <div style="width: 40px; height: 40px; border-radius: 8px; background: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                                                                <i data-lucide="image" size="18" class="text-muted"></i>
                                                            </div>
                                                        @endif
                                                        <span class="fw-semibold" style="font-size: 14px;">{{ $item['name'] }}</span>
                                                    </div>
                                                </td>
                                                <td class="text-center fw-bold">{{ number_format($item['quantity']) }}</td>
                                                <td class="text-end pe-4 fw-bold text-success">{{ number_format($item['revenue'], 0, ',', '.') }}₫</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="p-5 text-center text-muted">
            <i data-lucide="inbox" size="48" class="mb-3 opacity-50"></i>
            <h5>Không có dữ liệu</h5>
            <p>Không tìm thấy dữ liệu doanh thu nào khớp với bộ lọc hiện tại.</p>
        </div>
    @endif
</div>
@endsection
