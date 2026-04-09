@extends('layout.user')

@section('content')

<style>
    .cat-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: var(--text-muted);
        margin-bottom: 20px;
    }

    .cat-breadcrumb a {
        color: var(--text-muted);
        text-decoration: none;
        transition: var(--transition);
    }

    .cat-breadcrumb a:hover { color: var(--accent); }

    .cat-hero {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: var(--radius);
        padding: 36px 40px;
        margin-bottom: 30px;
        color: white;
    }

    .cat-hero h1 {
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .cat-hero p {
        font-size: 14px;
        opacity: 0.7;
        margin: 0;
    }
</style>

<!-- Breadcrumb -->
<div class="cat-breadcrumb">
    <a href="{{ route('home') }}">Trang chủ</a>
    <i data-lucide="chevron-right" size="14"></i>
    <span style="color: var(--text-dark); font-weight: 600;">{{ $cat->name }}</span>
</div>

<!-- Hero -->
<div class="cat-hero">
    <h1>{{ $cat->name }}</h1>
    <p>{{ $phones->count() }} sản phẩm</p>
</div>

<!-- Products Grid -->
<div class="row g-3">
    @foreach($phones as $p)
        @include('user.card')
    @endforeach
</div>

@if($phones->isEmpty())
    <div class="text-center py-5">
        <i data-lucide="inbox" size="56" style="color: var(--text-muted); opacity: 0.3;"></i>
        <p class="text-muted mt-3 mb-4">Chưa có sản phẩm nào trong danh mục này.</p>
        <a href="{{ route('home') }}" style="padding: 12px 28px; background: var(--primary); color: white; border-radius: 50px; font-weight: 700; text-decoration: none;">
            Quay lại trang chủ
        </a>
    </div>
@endif

@endsection