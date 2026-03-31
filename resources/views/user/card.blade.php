<div class="col-md-3 mb-4">
    <div class="card product-card position-relative">

        @if($p->is_featured)
            <span class="badge-hot">HOT</span>
        @endif

        <img src="/uploads/{{ $p->image }}" height="200" class="card-img-top">

        <div class="card-body text-center">

            <h6>{{ $p->name }}</h6>

            <p class="price">
                {{ number_format($p->price) }}đ
            </p>

            <small>🔥 Đã bán: {{ $p->sold }}</small>

            <div class="mt-2">
                <a href="/add/{{ $p->id }}" class="btn btn-success w-100">
                    🛒 Mua ngay
                </a>
            </div>

        </div>

    </div>
</div>