@extends('layout.user')

@section('content')

<!-- HERO BANNER -->
<div class="mb-5" style="border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow-lg);">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div style="height: 420px; background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); display: flex; align-items: center; padding: 0 60px;">
                    <div style="max-width: 500px;">
                        <span style="background: var(--accent); color: white; padding: 6px 16px; border-radius: 30px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Mới nhất 2026</span>
                        <h1 style="color: white; font-weight: 900; font-size: 42px; margin: 20px 0 12px; line-height: 1.1;">iPhone 16 Pro Max</h1>
                        <p style="color: rgba(255,255,255,0.7); font-size: 16px; margin-bottom: 28px;">Camera Control. Titan thế hệ mới. Chip A18 Pro cực mạnh. Apple Intelligence.</p>
                        <a href="{{ route('product.detail', 1) }}" class="btn" style="background: white; color: var(--primary); padding: 12px 36px; border-radius: 50px; font-weight: 700; font-size: 15px;">Khám phá ngay →</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div style="height: 420px; background: linear-gradient(135deg, #0c0c1d 0%, #1b1464 50%, #2d1b69 100%); display: flex; align-items: center; padding: 0 60px;">
                    <div style="max-width: 500px;">
                        <span style="background: #8b5cf6; color: white; padding: 6px 16px; border-radius: 30px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Galaxy AI</span>
                        <h1 style="color: white; font-weight: 900; font-size: 42px; margin: 20px 0 12px; line-height: 1.1;">Samsung Galaxy S24 Ultra</h1>
                        <p style="color: rgba(255,255,255,0.7); font-size: 16px; margin-bottom: 28px;">AI thế hệ mới. Camera 200MP. Khung titan cao cấp.</p>
                        <a href="{{ route('product.detail', 9) }}" class="btn" style="background: #8b5cf6; color: white; padding: 12px 36px; border-radius: 50px; font-weight: 700; font-size: 15px;">Mua ngay →</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div style="height: 420px; background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 50%, #404040 100%); display: flex; align-items: center; padding: 0 60px;">
                    <div style="max-width: 500px;">
                        <span style="background: var(--gold); color: #1a1a1a; padding: 6px 16px; border-radius: 30px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Ưu đãi hot</span>
                        <h1 style="color: white; font-weight: 900; font-size: 42px; margin: 20px 0 12px; line-height: 1.1;">Giảm giá đến 30%</h1>
                        <p style="color: rgba(255,255,255,0.7); font-size: 16px; margin-bottom: 28px;">Hàng ngàn sản phẩm chính hãng với giá ưu đãi cực sốc.</p>
                        <a href="{{ route('home') }}" class="btn" style="background: var(--gold); color: #1a1a1a; padding: 12px 36px; border-radius: 50px; font-weight: 700; font-size: 15px;">Xem tất cả →</a>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</div>

<!-- SẢN PHẨM NỔI BẬT -->
@if($featured->count())
<section class="mb-5">
    <h3 class="section-heading">
        <span class="icon-box" style="background: linear-gradient(135deg, #f59e0b, #f97316);">
            <i data-lucide="zap" size="20"></i>
        </span>
        Sản phẩm nổi bật
    </h3>
    <div class="row g-3">
        @foreach($featured as $p)
            @include('user.card')
        @endforeach
    </div>
</section>
@endif

<!-- BÁN CHẠY NHẤT -->
@if($bestSeller->count())
<section class="mb-5">
    <h3 class="section-heading">
        <span class="icon-box" style="background: linear-gradient(135deg, var(--accent), var(--accent-light));">
            <i data-lucide="trending-up" size="20"></i>
        </span>
        Bán chạy nhất
    </h3>
    <div class="row g-3">
        @foreach($bestSeller as $p)
            @include('user.card')
        @endforeach
    </div>
</section>
@endif

<!-- TẤT CẢ SẢN PHẨM -->
<section class="mb-5">
    <h3 class="section-heading">
        <span class="icon-box" style="background: linear-gradient(135deg, var(--secondary), #2563eb);">
            <i data-lucide="grid-3x3" size="20"></i>
        </span>
        Khám phá tất cả
    </h3>
    <div class="row g-3">
        @foreach($phones as $p)
            @include('user.card')
        @endforeach
    </div>

    @if($phones->isEmpty())
        <div class="text-center py-5">
            <i data-lucide="search-x" size="56" style="color: var(--text-muted); opacity: 0.3;"></i>
            <p class="text-muted mt-3 mb-0">Không tìm thấy sản phẩm nào.</p>
        </div>
    @endif

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $phones->appends(request()->query())->links() }}
    </div>
</section>

<!-- SCROLL ANIMATION -->
<style>
    .fade-up {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease-out;
    }
    .fade-up.visible {
        opacity: 1;
        transform: translateY(0);
    }
    @media (max-width: 768px) {
        #heroCarousel .carousel-item > div {
            height: 300px !important;
            padding: 0 30px !important;
        }
        #heroCarousel h1 {
            font-size: 28px !important;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) e.target.classList.add('visible');
        });
    }, { threshold: 0.1 });
    
    document.querySelectorAll('.product-card').forEach(el => {
        el.classList.add('fade-up');
        observer.observe(el);
    });
});
</script>

@endsection