@extends('layout.user')

@section('content')

<!-- PREMIMUM BANNER -->
<div class="premium-banner mb-5">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1616348436168-de43ad0db179?q=80&w=1600&auto=format&fit=crop" class="d-block w-100" style="height: 450px; object-fit: cover;" alt="iPhone 15 Pro">
                <div class="carousel-caption d-none d-md-block text-start" style="bottom: 20%; left: 10%;">
                    <h1 class="display-4 fw-bold">iPhone 15 Pro</h1>
                    <p class="lead">Titanium. So strong. So light. So Pro.</p>
                    <a href="#" class="btn btn-light btn-lg px-5 rounded-pill fw-bold">Mua ngay</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SẢN PHẨM NỔI BẬT -->
<div class="mb-5">
    <h3 class="section-title">
        <i data-lucide="zap" class="text-warning"></i> SẢN PHẨM NỔI BẬT
    </h3>
    <div class="row g-4">
    @foreach($featured as $p)
        @include('user.card')
    @endforeach
    </div>
</div>

<!-- BÁN CHẠY -->
<div class="mb-5">
    <h3 class="section-title">
        <i data-lucide="trending-up" class="text-danger"></i> BÁN CHẠY NHẤT
    </h3>
    <div class="row g-4">
    @foreach($bestSeller as $p)
        @include('user.card')
    @endforeach
    </div>
</div>

<!-- TẤT CẢ -->
<div class="mb-5">
    <h3 class="section-title">
        <i data-lucide="layout-grid" class="text-primary"></i> KHÁM PHÁ TẤT CẢ
    </h3>
    <div class="row g-4">
    @foreach($phones as $p)
        @include('user.card')
    @endforeach
    </div>

    <!-- Phân trang -->
    <div class="d-flex justify-content-center mt-4">
        {{ $phones->links() }}
    </div>
</div>

@endsection