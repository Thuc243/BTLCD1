@extends('layout.user')

@section('content')

@php
    $imgSrc = str_starts_with($phone->image ?? '', 'http') ? $phone->image : asset('uploads/' . $phone->image);

    // Parse description: tách phần overview và specs
    $descParts = explode("📱 THÔNG SỐ KỸ THUẬT:", $phone->description ?? '');
    $overview = trim($descParts[0] ?? '');
    $specsRaw = trim($descParts[1] ?? '');
    $specs = [];
    if ($specsRaw) {
        foreach (explode("\n", $specsRaw) as $line) {
            $line = trim($line);
            if (str_starts_with($line, '•')) {
                $line = trim(substr($line, strlen('•')));
                $parts = explode(':', $line, 2);
                if (count($parts) == 2) {
                    $specs[] = ['label' => trim($parts[0]), 'value' => trim($parts[1])];
                }
            }
        }
    }
@endphp

<style>
    .detail-breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--text-muted); margin-bottom: 20px; flex-wrap: wrap; }
    .detail-breadcrumb a { color: var(--text-muted); text-decoration: none; }
    .detail-breadcrumb a:hover { color: var(--accent); }

    .detail-img-box { background: linear-gradient(145deg, #fafafa, #f0f0f0); border-radius: var(--radius); padding: 40px; display: flex; align-items: center; justify-content: center; min-height: 420px; position: relative; }
    .detail-img-box img { max-width: 85%; max-height: 360px; object-fit: contain; transition: transform 0.5s ease; }
    .detail-img-box:hover img { transform: scale(1.05); }
    .detail-badge { position: absolute; top: 20px; left: 20px; padding: 6px 14px; border-radius: 8px; font-size: 11px; font-weight: 700; text-transform: uppercase; background: linear-gradient(135deg, var(--accent), var(--accent-light)); color: white; }

    .detail-info { padding-left: 20px; }
    .detail-category-tag { display: inline-block; padding: 4px 12px; border-radius: 6px; background: var(--bg-body); color: var(--text-muted); font-size: 12px; font-weight: 600; margin-bottom: 10px; }
    .detail-name { font-size: 26px; font-weight: 800; color: var(--text-dark); margin-bottom: 12px; line-height: 1.3; }

    .detail-stats { display: flex; gap: 20px; margin-bottom: 20px; flex-wrap: wrap; }
    .detail-stat-item { display: flex; align-items: center; gap: 6px; font-size: 13px; color: var(--text-muted); }
    .detail-stat-item i { flex-shrink: 0; }

    .detail-price-box { background: linear-gradient(135deg, #fff5f5, #fff0f0); border: 1px solid rgba(233,69,96,0.15); border-radius: var(--radius-sm); padding: 18px 22px; margin-bottom: 22px; }
    .detail-price { font-size: 30px; font-weight: 900; color: var(--accent); }
    .detail-price-note { font-size: 13px; color: var(--text-muted); margin-top: 4px; }

    .detail-highlights { background: var(--bg-body); border-radius: var(--radius-sm); padding: 18px 20px; margin-bottom: 22px; }
    .detail-highlights h6 { font-weight: 700; font-size: 14px; margin-bottom: 12px; display: flex; align-items: center; gap: 8px; }
    .highlight-list { list-style: none; padding: 0; margin: 0; }
    .highlight-list li { display: flex; align-items: flex-start; gap: 8px; font-size: 13px; margin-bottom: 8px; color: #444; line-height: 1.5; }
    .highlight-list li i { color: #10b981; margin-top: 3px; flex-shrink: 0; }

    .detail-actions { display: flex; gap: 12px; flex-wrap: wrap; }
    .btn-buy-now { flex: 1; min-width: 160px; height: 50px; border: none; border-radius: var(--radius-sm); background: linear-gradient(135deg, var(--accent), var(--accent-light)); color: white; font-weight: 700; font-size: 15px; font-family: inherit; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: var(--transition); text-decoration: none; }
    .btn-buy-now:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(233,69,96,0.35); color: white; }
    .btn-add-detail { flex: 1; min-width: 160px; height: 50px; border: 2px solid var(--primary); border-radius: var(--radius-sm); background: transparent; color: var(--primary); font-weight: 700; font-size: 15px; font-family: inherit; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: var(--transition); text-decoration: none; }
    .btn-add-detail:hover { background: var(--primary); color: white; }

    /* TABS */
    .detail-tabs { margin-top: 40px; }
    .detail-nav-tabs { border-bottom: 2px solid var(--border-light); gap: 0; }
    .detail-nav-tabs .nav-link { border: none; border-bottom: 3px solid transparent; padding: 14px 24px; font-weight: 700; font-size: 14px; color: var(--text-muted); transition: var(--transition); border-radius: 0; }
    .detail-nav-tabs .nav-link.active { color: var(--accent); border-bottom-color: var(--accent); background: transparent; }
    .detail-nav-tabs .nav-link:hover { color: var(--text-dark); }
    .tab-content { padding-top: 24px; }

    /* SPECS TABLE */
    .specs-table { width: 100%; border-collapse: collapse; }
    .specs-table tr { border-bottom: 1px solid var(--border-light); }
    .specs-table tr:nth-child(even) { background: #fafbfc; }
    .specs-table td { padding: 13px 18px; font-size: 14px; }
    .specs-table td:first-child { font-weight: 600; color: var(--text-dark); width: 180px; white-space: nowrap; }
    .specs-table td:last-child { color: #444; }

    /* OVERVIEW */
    .overview-text { font-size: 15px; line-height: 1.9; color: #444; }
    .overview-text p { margin-bottom: 16px; }

    /* GUARANTEE */
    .guarantee-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; }
    .guarantee-item { display: flex; align-items: center; gap: 14px; padding: 18px; background: var(--bg-body); border-radius: var(--radius-sm); }
    .guarantee-icon { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .guarantee-item h6 { font-size: 13px; font-weight: 700; margin: 0 0 2px; }
    .guarantee-item p { font-size: 11px; color: var(--text-muted); margin: 0; }

    @media (max-width: 768px) {
        .detail-info { padding-left: 0; margin-top: 24px; }
        .detail-name { font-size: 22px; }
        .detail-price { font-size: 26px; }
    }
</style>

<!-- Breadcrumb -->
<div class="detail-breadcrumb">
    <a href="{{ route('home') }}">Trang chủ</a>
    <i data-lucide="chevron-right" size="14"></i>
    @if($phone->category)
        <a href="{{ route('category', $phone->category_id) }}">{{ $phone->category->name }}</a>
        <i data-lucide="chevron-right" size="14"></i>
    @endif
    <span style="color: var(--text-dark); font-weight: 600;">{{ $phone->name }}</span>
</div>

<div class="row">
    <!-- Image -->
    <div class="col-lg-5 mb-4">
        <div class="detail-img-box">
            @if($phone->is_featured) <span class="detail-badge">🔥 Hot</span> @endif
            <img src="{{ $imgSrc }}" alt="{{ $phone->name }}">
        </div>

        <!-- Guarantee badges under image -->
        <div class="guarantee-grid mt-3">
            <div class="guarantee-item">
                <div class="guarantee-icon" style="background: #ecfdf5; color: #10b981;"><i data-lucide="shield-check" size="20"></i></div>
                <div><h6>Chính hãng 100%</h6><p>Nguyên seal, đầy đủ phụ kiện</p></div>
            </div>
            <div class="guarantee-item">
                <div class="guarantee-icon" style="background: #eff6ff; color: #3b82f6;"><i data-lucide="repeat" size="20"></i></div>
                <div><h6>Đổi trả 30 ngày</h6><p>Nếu lỗi do nhà sản xuất</p></div>
            </div>
            <div class="guarantee-item">
                <div class="guarantee-icon" style="background: #fef3c7; color: #d97706;"><i data-lucide="truck" size="20"></i></div>
                <div><h6>Miễn phí giao hàng</h6><p>Toàn quốc, 1-3 ngày</p></div>
            </div>
            <div class="guarantee-item">
                <div class="guarantee-icon" style="background: #fce7f3; color: #ec4899;"><i data-lucide="headphones" size="20"></i></div>
                <div><h6>Hỗ trợ 24/7</h6><p>Tư vấn mua hàng miễn phí</p></div>
            </div>
        </div>
    </div>

    <!-- Info -->
    <div class="col-lg-7">
        <div class="detail-info">
            @if($phone->category)
                <span class="detail-category-tag">{{ $phone->category->name }}</span>
            @endif
            <h1 class="detail-name">{{ $phone->name }}</h1>

            <div class="detail-stats">
                <div class="detail-stat-item"><i data-lucide="star" size="15" fill="#f59e0b" stroke="none"></i> 4.{{ rand(5,9) }}/5 ({{ rand(100,999) }} đánh giá)</div>
                <div class="detail-stat-item"><i data-lucide="flame" size="15" style="color: var(--accent);"></i> Đã bán {{ number_format($phone->sold) }}</div>
                <div class="detail-stat-item"><i data-lucide="shield-check" size="15" style="color: #10b981;"></i> Chính hãng</div>
            </div>

            <div class="detail-price-box">
                <div class="detail-price">{{ number_format($phone->price, 0, ',', '.') }}₫</div>
                <div class="detail-price-note">Giá đã bao gồm VAT • Miễn phí vận chuyển toàn quốc • Trả góp 0%</div>
            </div>

            <!-- Quick Specs from parsed data -->
            @if(count($specs) > 0)
            <div class="detail-highlights">
                <h6><i data-lucide="cpu" size="16"></i> Cấu hình chính</h6>
                <ul class="highlight-list">
                    @foreach(array_slice($specs, 0, 6) as $s)
                        <li><i data-lucide="check" size="14"></i> <strong>{{ $s['label'] }}:</strong> {{ $s['value'] }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Overview text -->
            @if($overview)
            <div class="mb-4" style="font-size: 14px; color: #555; line-height: 1.8;">
                {{ $overview }}
            </div>
            @endif

            <div class="detail-actions">
                <a href="{{ route('add', $phone->id) }}" class="btn-buy-now">
                    <i data-lucide="zap" size="18"></i> MUA NGAY
                </a>
                <a href="{{ route('add', $phone->id) }}" class="btn-add-detail">
                    <i data-lucide="shopping-bag" size="18"></i> THÊM VÀO GIỎ
                </a>
            </div>
        </div>
    </div>
</div>

<!-- TABS: Chi tiết + Thông số + Chính sách -->
<div class="detail-tabs">
    <ul class="nav detail-nav-tabs" role="tablist">
        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tabOverview">Giới thiệu sản phẩm</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tabSpecs">Thông số kỹ thuật</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tabPolicy">Chính sách bảo hành</a></li>
    </ul>

    <div class="tab-content">
        <!-- Tab 1: Overview -->
        <div class="tab-pane fade show active" id="tabOverview">
            <div class="overview-text">
                <p>{{ $overview }}</p>

                @if(count($specs) > 0)
                <h5 style="font-weight: 800; margin: 24px 0 16px;">📱 Điểm nổi bật</h5>
                <ul style="padding-left: 20px;">
                    @foreach($specs as $s)
                        <li style="margin-bottom: 8px;"><strong>{{ $s['label'] }}</strong>: {{ $s['value'] }}</li>
                    @endforeach
                </ul>
                @endif

                <h5 style="font-weight: 800; margin: 24px 0 16px;">🎯 Tại sao nên chọn {{ $phone->name }}?</h5>
                <ul style="padding-left: 20px;">
                    <li style="margin-bottom: 8px;">Sản phẩm chính hãng 100%, nguyên seal hộp.</li>
                    <li style="margin-bottom: 8px;">Bảo hành chính hãng 12 tháng tại các trung tâm ủy quyền.</li>
                    <li style="margin-bottom: 8px;">Miễn phí giao hàng toàn quốc trong 1-3 ngày làm việc.</li>
                    <li style="margin-bottom: 8px;">Hỗ trợ trả góp 0% lãi suất qua thẻ tín dụng/công ty tài chính.</li>
                    <li style="margin-bottom: 8px;">Đổi trả miễn phí trong 30 ngày nếu lỗi nhà sản xuất.</li>
                </ul>
            </div>
        </div>

        <!-- Tab 2: Specs Table -->
        <div class="tab-pane fade" id="tabSpecs">
            @if(count($specs) > 0)
            <div class="card overflow-hidden" style="border: 1px solid var(--border-light);">
                <table class="specs-table">
                    @foreach($specs as $s)
                    <tr>
                        <td>{{ $s['label'] }}</td>
                        <td>{{ $s['value'] }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
            @else
            <p class="text-muted">Thông số kỹ thuật đang được cập nhật.</p>
            @endif
        </div>

        <!-- Tab 3: Policy -->
        <div class="tab-pane fade" id="tabPolicy">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card p-4 h-100" style="border: 1px solid var(--border-light);">
                        <h6 class="fw-bold mb-3" style="color: #10b981;"><i data-lucide="shield" size="18" class="me-2"></i>Bảo hành</h6>
                        <ul class="small" style="padding-left: 18px; color: #555; line-height: 2;">
                            <li>Bảo hành chính hãng 12 tháng.</li>
                            <li>1 đổi 1 trong 30 ngày đầu nếu lỗi phần cứng.</li>
                            <li>Hỗ trợ sửa chữa ngoài bảo hành với giá ưu đãi.</li>
                            <li>Trung tâm bảo hành trên toàn quốc.</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card p-4 h-100" style="border: 1px solid var(--border-light);">
                        <h6 class="fw-bold mb-3" style="color: #3b82f6;"><i data-lucide="truck" size="18" class="me-2"></i>Vận chuyển</h6>
                        <ul class="small" style="padding-left: 18px; color: #555; line-height: 2;">
                            <li>Miễn phí giao hàng toàn quốc.</li>
                            <li>Nội thành HCM, HN: nhận trong 1-2h.</li>
                            <li>Tỉnh thành khác: 1-3 ngày làm việc.</li>
                            <li>Đóng gói cẩn thận, chống sốc.</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card p-4 h-100" style="border: 1px solid var(--border-light);">
                        <h6 class="fw-bold mb-3" style="color: #d97706;"><i data-lucide="credit-card" size="18" class="me-2"></i>Thanh toán</h6>
                        <ul class="small" style="padding-left: 18px; color: #555; line-height: 2;">
                            <li>COD - Thanh toán khi nhận hàng.</li>
                            <li>Chuyển khoản ngân hàng (QR Code).</li>
                            <li>Trả góp 0% qua thẻ tín dụng (6-12 tháng).</li>
                            <li>Trả góp qua công ty tài chính.</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card p-4 h-100" style="border: 1px solid var(--border-light);">
                        <h6 class="fw-bold mb-3" style="color: #ec4899;"><i data-lucide="repeat" size="18" class="me-2"></i>Đổi trả</h6>
                        <ul class="small" style="padding-left: 18px; color: #555; line-height: 2;">
                            <li>Đổi trả miễn phí trong 30 ngày.</li>
                            <li>Sản phẩm phải còn nguyên seal/phụ kiện.</li>
                            <li>Hoàn tiền 100% nếu lỗi nhà sản xuất.</li>
                            <li>Hỗ trợ đổi size/model nếu còn hàng.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SẢN PHẨM LIÊN QUAN -->
@if($related->count())
<section class="mt-5 mb-4">
    <h3 class="section-heading">
        <span class="icon-box" style="background: linear-gradient(135deg, #8b5cf6, #a78bfa);">
            <i data-lucide="sparkles" size="20"></i>
        </span>
        Sản phẩm liên quan
    </h3>
    <div class="row g-3">
        @foreach($related as $p)
            @include('user.card')
        @endforeach
    </div>
</section>
@endif

@endsection
