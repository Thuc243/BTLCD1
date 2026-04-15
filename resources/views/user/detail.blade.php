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

    /* ═══════ REVIEWS & COMMENTS ═══════ */
    .review-overview {
        display: flex;
        gap: 40px;
        padding: 28px;
        background: linear-gradient(135deg, #fffbeb, #fef3c7);
        border-radius: var(--radius);
        margin-bottom: 28px;
        align-items: center;
        flex-wrap: wrap;
    }

    .review-score-box {
        text-align: center;
        min-width: 140px;
    }

    .review-score-number {
        font-size: 52px;
        font-weight: 900;
        color: #d97706;
        line-height: 1;
        margin-bottom: 8px;
    }

    .review-score-stars { display: flex; gap: 3px; justify-content: center; margin-bottom: 6px; }
    .review-score-count { font-size: 13px; color: var(--text-muted); }

    .review-distribution { flex: 1; min-width: 200px; }

    .review-bar-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 6px;
    }

    .review-bar-label {
        display: flex;
        align-items: center;
        gap: 3px;
        font-size: 13px;
        font-weight: 600;
        width: 36px;
        color: #444;
    }

    .review-bar-track {
        flex: 1;
        height: 10px;
        background: #e5e7eb;
        border-radius: 50px;
        overflow: hidden;
    }

    .review-bar-fill {
        height: 100%;
        border-radius: 50px;
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        transition: width 0.6s ease;
    }

    .review-bar-count {
        font-size: 12px;
        color: var(--text-muted);
        width: 28px;
        text-align: right;
    }

    /* Review form */
    .review-form-section {
        background: white;
        border: 1px solid var(--border-light);
        border-radius: var(--radius);
        padding: 24px;
        margin-bottom: 28px;
    }

    .review-form-title {
        font-weight: 700;
        font-size: 16px;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .star-rating-input {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }

    .star-label {
        font-size: 14px;
        font-weight: 600;
        color: #444;
    }

    .star-select { display: flex; gap: 4px; }

    .star-btn {
        background: none;
        border: none;
        cursor: pointer;
        padding: 4px;
        color: #d1d5db;
        transition: all 0.2s ease;
        border-radius: 4px;
    }

    .star-btn:hover { transform: scale(1.2); }
    .star-btn.active { color: #f59e0b; }
    .star-btn.active i { fill: #f59e0b; stroke: #f59e0b; }

    .star-text {
        font-size: 14px;
        font-weight: 600;
        color: #d97706;
        min-width: 80px;
    }

    .review-textarea {
        width: 100%;
        border: 2px solid var(--border-light);
        border-radius: var(--radius-sm);
        padding: 14px 16px;
        font-size: 14px;
        font-family: inherit;
        resize: vertical;
        min-height: 100px;
        transition: var(--transition);
        outline: none;
        margin-bottom: 14px;
    }

    .review-textarea:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 4px rgba(233,69,96,0.08);
    }

    .btn-submit-review {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 28px;
        border-radius: 50px;
        background: linear-gradient(135deg, var(--accent), var(--accent-light));
        color: white;
        border: none;
        font-weight: 700;
        font-size: 14px;
        font-family: inherit;
        cursor: pointer;
        transition: var(--transition);
    }

    .btn-submit-review:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(233,69,96,0.35);
    }

    .review-login-prompt {
        text-align: center;
        padding: 32px;
        color: var(--text-muted);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .review-login-prompt a {
        color: var(--accent);
        font-weight: 700;
        text-decoration: underline;
    }

    /* Review list */
    .review-list-section { margin-bottom: 20px; }

    .review-list-title {
        font-weight: 700;
        font-size: 16px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
        padding-bottom: 14px;
        border-bottom: 2px solid var(--border-light);
    }

    .review-item {
        padding: 20px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .review-item:last-child { border-bottom: none; }

    .review-header { display: flex; gap: 12px; align-items: flex-start; margin-bottom: 12px; }

    .review-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6366f1, #a78bfa);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 16px;
        flex-shrink: 0;
    }

    .review-meta { flex: 1; }

    .review-author {
        font-weight: 700;
        font-size: 14px;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .review-badge-admin {
        font-size: 10px;
        padding: 2px 8px;
        border-radius: 4px;
        background: linear-gradient(135deg, #3b82f6, #60a5fa);
        color: white;
        font-weight: 700;
        text-transform: uppercase;
    }

    .review-info {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 3px;
    }

    .review-stars-small { display: flex; gap: 1px; }
    .review-time { font-size: 12px; color: var(--text-muted); }

    .review-content {
        font-size: 14px;
        line-height: 1.7;
        color: #374151;
        margin-left: 54px;
        margin-bottom: 10px;
        white-space: pre-line;
    }

    .review-actions {
        margin-left: 54px;
        display: flex;
        gap: 14px;
        align-items: center;
    }

    .btn-reply-toggle {
        background: none;
        border: none;
        color: var(--text-muted);
        font-size: 13px;
        font-weight: 600;
        font-family: inherit;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 4px;
        padding: 4px 8px;
        border-radius: 6px;
        transition: var(--transition);
    }

    .btn-reply-toggle:hover { background: var(--bg-body); color: var(--accent); }

    .btn-review-delete {
        background: none;
        border: none;
        color: #ef4444;
        font-size: 13px;
        font-weight: 600;
        font-family: inherit;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 4px;
        padding: 4px 8px;
        border-radius: 6px;
        transition: var(--transition);
        opacity: 0.6;
    }

    .btn-review-delete:hover { opacity: 1; background: #fef2f2; }

    /* Reply form */
    .reply-form-box {
        margin-left: 54px;
        margin-top: 14px;
        padding: 16px;
        background: #f9fafb;
        border-radius: var(--radius-sm);
        border: 1px solid var(--border-light);
    }

    .reply-input-group { display: flex; gap: 10px; align-items: flex-start; }

    .reply-avatar-sm {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent), #ff8a5c);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 12px;
        flex-shrink: 0;
    }

    .reply-textarea {
        flex: 1;
        border: 2px solid var(--border-light);
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 13px;
        font-family: inherit;
        resize: none;
        outline: none;
        transition: var(--transition);
    }

    .reply-textarea:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(233,69,96,0.08);
    }

    .reply-actions {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        margin-top: 10px;
    }

    .btn-reply-cancel {
        padding: 8px 18px;
        border-radius: 8px;
        border: 1px solid var(--border-light);
        background: white;
        font-size: 13px;
        font-weight: 600;
        font-family: inherit;
        cursor: pointer;
        transition: var(--transition);
    }

    .btn-reply-cancel:hover { background: #f3f4f6; }

    .btn-reply-submit {
        padding: 8px 18px;
        border-radius: 8px;
        border: none;
        background: linear-gradient(135deg, var(--accent), var(--accent-light));
        color: white;
        font-size: 13px;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: var(--transition);
    }

    .btn-reply-submit:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(233,69,96,0.3); }

    /* Threaded replies */
    .replies-thread {
        margin-left: 54px;
        margin-top: 14px;
    }

    .reply-item {
        padding: 14px 0 14px 18px;
        border-left: 3px solid #e5e7eb;
        margin-bottom: 4px;
        position: relative;
    }

    .reply-item:hover { border-left-color: var(--accent); }

    .reply-header { display: flex; gap: 10px; align-items: flex-start; margin-bottom: 8px; }

    .reply-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 12px;
        flex-shrink: 0;
    }

    .reply-author {
        font-weight: 700;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .reply-to-label {
        font-size: 12px;
        color: var(--text-muted);
        font-weight: 400;
    }

    .reply-content {
        font-size: 13px;
        line-height: 1.6;
        color: #374151;
        margin-left: 42px;
        white-space: pre-line;
    }

    .reply-time {
        font-size: 11px;
        color: var(--text-muted);
        margin-top: 2px;
    }

    .reply-actions-row {
        margin-left: 42px;
        margin-top: 6px;
        display: flex;
        gap: 10px;
    }

    /* Empty state */
    .review-empty {
        text-align: center;
        padding: 48px 20px;
        color: var(--text-muted);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
    }

    .review-empty p { font-size: 14px; }

    @media (max-width: 768px) {
        .detail-info { padding-left: 0; margin-top: 24px; }
        .detail-name { font-size: 22px; }
        .detail-price { font-size: 26px; }
        .review-overview { flex-direction: column; gap: 20px; }
        .review-content, .review-actions, .reply-form-box, .replies-thread { margin-left: 0; }
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
                <div class="detail-stat-item"><i data-lucide="star" size="15" fill="#f59e0b" stroke="none"></i> {{ $reviewCount > 0 ? number_format($avgRating, 1) : '0' }}/5 ({{ $reviewCount }} đánh giá)</div>
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
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#tabReviews">
                Đánh giá & Bình luận
                @if($reviewCount > 0)
                    <span style="background: var(--accent); color: white; font-size: 11px; padding: 2px 8px; border-radius: 50px; margin-left: 6px;">{{ $reviewCount }}</span>
                @endif
            </a>
        </li>
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

        <!-- Tab 4: Reviews & Comments -->
        <div class="tab-pane fade" id="tabReviews">
            <!-- Rating Overview -->
            <div class="review-overview">
                <div class="review-score-box">
                    <div class="review-score-number">{{ $reviewCount > 0 ? number_format($avgRating, 1) : '0.0' }}</div>
                    <div class="review-score-stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= round($avgRating))
                                <i data-lucide="star" size="18" fill="#f59e0b" stroke="none"></i>
                            @else
                                <i data-lucide="star" size="18" fill="#e5e7eb" stroke="none"></i>
                            @endif
                        @endfor
                    </div>
                    <div class="review-score-count">{{ $reviewCount }} đánh giá</div>
                </div>
                <div class="review-distribution">
                    @for($i = 5; $i >= 1; $i--)
                        @php $pct = $reviewCount > 0 ? round(($ratingDistribution[$i] / $reviewCount) * 100) : 0; @endphp
                        <div class="review-bar-row">
                            <span class="review-bar-label">{{ $i }} <i data-lucide="star" size="12" fill="#f59e0b" stroke="none"></i></span>
                            <div class="review-bar-track">
                                <div class="review-bar-fill" style="width: {{ $pct }}%"></div>
                            </div>
                            <span class="review-bar-count">{{ $ratingDistribution[$i] }}</span>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Write Review Form -->
            <div class="review-form-section">
                @auth
                    <h6 class="review-form-title">
                        <i data-lucide="edit-3" size="18"></i>
                        {{ $userReview ? 'Cập nhật đánh giá của bạn' : 'Viết đánh giá' }}
                    </h6>
                    <form action="{{ route('review.store', $phone->id) }}" method="POST" class="review-form">
                        @csrf
                        <div class="star-rating-input">
                            <span class="star-label">Đánh giá của bạn:</span>
                            <div class="star-select" id="starSelect">
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="button" class="star-btn {{ $userReview && $userReview->rating >= $i ? 'active' : '' }}" data-value="{{ $i }}">
                                        <i data-lucide="star" size="28"></i>
                                    </button>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="ratingInput" value="{{ $userReview ? $userReview->rating : '' }}">
                            <span class="star-text" id="starText">
                                @if($userReview)
                                    @switch($userReview->rating)
                                        @case(1) Rất tệ @break
                                        @case(2) Tệ @break
                                        @case(3) Bình thường @break
                                        @case(4) Tốt @break
                                        @case(5) Tuyệt vời @break
                                    @endswitch
                                @endif
                            </span>
                        </div>
                        @error('rating')
                            <div class="text-danger small mb-2">{{ $message }}</div>
                        @enderror
                        <textarea name="content" class="review-textarea" rows="4" placeholder="Chia sẻ nhận xét của bạn về sản phẩm này...">{{ $userReview ? $userReview->content : old('content') }}</textarea>
                        @error('content')
                            <div class="text-danger small mb-2">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn-submit-review">
                            <i data-lucide="send" size="16"></i>
                            {{ $userReview ? 'Cập nhật đánh giá' : 'Gửi đánh giá' }}
                        </button>
                    </form>
                @else
                    <div class="review-login-prompt">
                        <i data-lucide="user" size="24"></i>
                        <p>Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để viết đánh giá và bình luận.</p>
                    </div>
                @endauth
            </div>

            <!-- Reviews List -->
            <div class="review-list-section">
                <h6 class="review-list-title">
                    <i data-lucide="message-square" size="18"></i>
                    Tất cả đánh giá ({{ $reviewCount }})
                </h6>

                @forelse($reviews as $review)
                    <div class="review-item" id="review-{{ $review->id }}">
                        <div class="review-header">
                            <div class="review-avatar">{{ strtoupper(substr($review->user->name, 0, 1)) }}</div>
                            <div class="review-meta">
                                <div class="review-author">
                                    {{ $review->user->name }}
                                    @if($review->user->role === 'admin')
                                        <span class="review-badge-admin">Admin</span>
                                    @endif
                                </div>
                                <div class="review-info">
                                    <div class="review-stars-small">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i data-lucide="star" size="13" fill="{{ $i <= $review->rating ? '#f59e0b' : '#e5e7eb' }}" stroke="none"></i>
                                        @endfor
                                    </div>
                                    <span class="review-time">{{ $review->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="review-content">{{ $review->content }}</div>
                        <div class="review-actions">
                            @auth
                                <button class="btn-reply-toggle" onclick="toggleReplyForm({{ $review->id }})">
                                    <i data-lucide="corner-down-right" size="14"></i> Trả lời
                                </button>
                            @endauth
                            @auth
                                @if(Auth::id() === $review->user_id || auth()->user()->role === 'admin')
                                    <form action="{{ route('review.delete', $review->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                        @csrf @method('DELETE')
                                        <button class="btn-review-delete"><i data-lucide="trash-2" size="13"></i> Xóa</button>
                                    </form>
                                @endif
                            @endauth
                        </div>

                        <!-- Reply Form (hidden default) -->
                        @auth
                        <div class="reply-form-box" id="replyForm-{{ $review->id }}" style="display:none">
                            <form action="{{ route('review.reply', $review->id) }}" method="POST" class="reply-form">
                                @csrf
                                <div class="reply-input-group">
                                    <div class="reply-avatar-sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                                    <textarea name="content" rows="2" class="reply-textarea" placeholder="Viết phản hồi..."></textarea>
                                </div>
                                <div class="reply-actions">
                                    <button type="button" class="btn-reply-cancel" onclick="toggleReplyForm({{ $review->id }})">Hủy</button>
                                    <button type="submit" class="btn-reply-submit"><i data-lucide="send" size="14"></i> Gửi</button>
                                </div>
                            </form>
                        </div>
                        @endauth

                        <!-- Replies (threaded) -->
                        @if($review->replies->count() > 0)
                            <div class="replies-thread">
                                @foreach($review->replies as $reply)
                                    @include('user._reply', ['reply' => $reply, 'depth' => 1])
                                @endforeach
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="review-empty">
                        <i data-lucide="message-circle" size="48" style="color: #d1d5db;"></i>
                        <p>Chưa có đánh giá nào. Hãy là người đầu tiên đánh giá sản phẩm này!</p>
                    </div>
                @endforelse
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

@section('scripts')
<script>
    // ═══════ STAR RATING INTERACTION ═══════
    const starTexts = ['', 'Rất tệ', 'Tệ', 'Bình thường', 'Tốt', 'Tuyệt vời'];
    const starSelect = document.getElementById('starSelect');
    const ratingInput = document.getElementById('ratingInput');
    const starText = document.getElementById('starText');

    if (starSelect) {
        const starBtns = starSelect.querySelectorAll('.star-btn');
        starBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const val = parseInt(this.dataset.value);
                ratingInput.value = val;
                starText.textContent = starTexts[val];

                starBtns.forEach(b => {
                    const bVal = parseInt(b.dataset.value);
                    if (bVal <= val) {
                        b.classList.add('active');
                    } else {
                        b.classList.remove('active');
                    }
                });
            });

            // Hover preview
            btn.addEventListener('mouseenter', function() {
                const val = parseInt(this.dataset.value);
                starBtns.forEach(b => {
                    const bVal = parseInt(b.dataset.value);
                    if (bVal <= val) {
                        b.style.color = '#fbbf24';
                    } else {
                        b.style.color = '';
                    }
                });
            });
        });

        starSelect.addEventListener('mouseleave', function() {
            const currentVal = parseInt(ratingInput.value) || 0;
            starBtns.forEach(b => {
                b.style.color = '';
            });
        });
    }

    // ═══════ TOGGLE REPLY FORM ═══════
    function toggleReplyForm(id) {
        const form = document.getElementById('replyForm-' + id);
        if (form) {
            if (form.style.display === 'none') {
                // Close all other open reply forms
                document.querySelectorAll('.reply-form-box').forEach(f => f.style.display = 'none');
                form.style.display = 'block';
                form.querySelector('textarea').focus();
            } else {
                form.style.display = 'none';
            }
        }
    }

    // Re-init Lucide icons for dynamic content
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>
@endsection
