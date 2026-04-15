<style>
    .product-card {
        border: none;
        border-radius: var(--radius);
        overflow: hidden;
        transition: var(--transition);
        background: white;
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
        box-shadow: var(--shadow-sm);
    }
    .product-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-hover); }
    .card-img-wrapper {
        padding: 24px;
        background: linear-gradient(145deg, #fafafa, #f0f0f0);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        aspect-ratio: 1;
    }
    .card-img-wrapper img {
        max-width: 75%;
        max-height: 160px;
        object-fit: contain;
        transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    .product-card:hover .card-img-wrapper img { transform: scale(1.08); }
    .card-badge { position: absolute; top: 12px; left: 12px; padding: 4px 10px; border-radius: 6px; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; z-index: 2; }
    .badge-hot { background: linear-gradient(135deg, var(--accent), var(--accent-light)); color: white; }
    .card-actions { position: absolute; top: 12px; right: 12px; display: flex; flex-direction: column; gap: 6px; opacity: 0; transform: translateX(10px); transition: var(--transition); z-index: 2; }
    .product-card:hover .card-actions { opacity: 1; transform: translateX(0); }
    .card-action-btn { width: 34px; height: 34px; border-radius: 50%; background: white; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: var(--shadow-md); transition: var(--transition); color: var(--text-dark); text-decoration: none; }
    .card-action-btn:hover { background: var(--accent); color: white; }
    .card-body-custom { padding: 16px 20px 20px; flex-grow: 1; display: flex; flex-direction: column; }
    .card-category { font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted); margin-bottom: 6px; }
    .card-title-custom { font-weight: 700; font-size: 15px; color: var(--text-dark); display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 44px; margin-bottom: 10px; line-height: 1.45; }
    .card-title-custom a { color: inherit; text-decoration: none; transition: var(--transition); }
    .card-title-custom a:hover { color: var(--accent); }
    .card-meta { display: flex; align-items: center; justify-content: space-between; font-size: 12px; color: var(--text-muted); margin-bottom: 14px; }
    .card-sold { display: flex; align-items: center; gap: 4px; }
    .card-rating { display: flex; align-items: center; gap: 3px; color: var(--gold); }
    .card-price { font-size: 20px; font-weight: 800; color: var(--accent); margin-bottom: 14px; }
    .btn-add-cart { width: 100%; height: 42px; border: 2px solid var(--primary); border-radius: var(--radius-sm); background: transparent; color: var(--primary); font-weight: 700; font-size: 13px; font-family: inherit; cursor: pointer; transition: var(--transition); display: flex; align-items: center; justify-content: center; gap: 8px; text-decoration: none; margin-top: auto; }
    .btn-add-cart:hover { background: var(--primary); color: white; transform: translateY(-1px); box-shadow: 0 4px 15px rgba(26,26,46,0.25); }
</style>

@php
    $imgSrc = str_starts_with($p->image ?? '', 'http') ? $p->image : asset('uploads/' . $p->image);
@endphp

<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
    <div class="card product-card">
        <div class="card-img-wrapper">
            @if($p->is_featured)
                <span class="card-badge badge-hot">🔥 Hot</span>
            @endif
            <div class="card-actions">
                <a href="{{ route('product.detail', $p->id) }}" class="card-action-btn" title="Xem chi tiết">
                    <i data-lucide="eye" size="15"></i>
                </a>
            </div>
            <a href="{{ route('product.detail', $p->id) }}">
                <img src="{{ $imgSrc }}" alt="{{ $p->name }}" loading="lazy">
            </a>
        </div>
        <div class="card-body-custom">
            @if($p->category)
                <span class="card-category">{{ $p->category->name }}</span>
            @endif
            <h6 class="card-title-custom">
                <a href="{{ route('product.detail', $p->id) }}">{{ $p->name }}</a>
            </h6>
            <div class="card-meta">
                <span class="card-sold"><i data-lucide="flame" size="12"></i> Đã bán {{ number_format($p->sold) }}</span>
                @php $cardRating = $p->avgRating(); @endphp
                <span class="card-rating"><i data-lucide="star" size="12" fill="currentColor" stroke="none"></i> {{ $cardRating > 0 ? number_format($cardRating, 1) : '0.0' }}</span>
            </div>
            <div class="card-price">{{ number_format($p->price, 0, ',', '.') }}₫</div>
            <a href="{{ route('add', $p->id) }}" class="btn-add-cart">
                <i data-lucide="shopping-bag" size="16"></i> Thêm vào giỏ
            </a>
        </div>
    </div>
</div>