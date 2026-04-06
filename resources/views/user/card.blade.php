<style>
    .product-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        background: white;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }

    .img-container {
        padding: 20px;
        background: #fdfdfd;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .img-container img {
        max-width: 100%;
        height: 180px;
        object-fit: contain;
        transition: 0.5s;
    }

    .product-card:hover .img-container img {
        transform: scale(1.1);
    }

    .badge-premium {
        position: absolute;
        top: 15px;
        left: 15px;
        background: var(--primary);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .product-info {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .product-name {
        font-weight: 700;
        font-size: 16px;
        margin-bottom: 8px;
        color: var(--text-dark);
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 48px;
    }

    .product-price {
        font-size: 18px;
        font-weight: 800;
        color: #d0021b;
        margin-bottom: 10px;
    }

    .btn-buy {
        background: var(--primary);
        color: white;
        border: none;
        padding: 10px;
        border-radius: 8px;
        font-weight: 600;
        width: 100%;
        transition: 0.3s;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-buy:hover {
        background: var(--secondary);
        color: white;
        box-shadow: 0 5px 15px rgba(0, 116, 217, 0.3);
    }
</style>

<div class="col-md-3 mb-4">
    <div class="card product-card">
        <div class="img-container">
            @if($p->is_featured)
                <span class="badge-premium">Hot</span>
            @endif
            <img src="{{ asset('uploads/' . $p->image) }}" alt="{{ $p->name }}">
        </div>

        <div class="product-info">
            <div>
                <h6 class="product-name">{{ $p->name }}</h6>
                <div class="product-price">
                    {{ number_format($p->price, 0, ',', '.') }}đ
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted small">🔥 Đã bán: {{ $p->sold }}</span>
                    <span class="text-warning small">
                        <i data-lucide="star" size="14" fill="currentColor"></i> 5.0
                    </span>
                </div>
            </div>
            
            <a href="{{ route('add', $p->id) }}" class="btn-buy">
                Thêm vào giỏ
            </a>
        </div>
    </div>
</div>