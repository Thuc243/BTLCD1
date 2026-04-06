@extends('layout.admin')

@section('content')

<div class="row g-4 mb-4">
    <!-- Cột 1 -->
    <div class="col-md-4">
        <div class="stats-card shadow-sm border-0">
            <div class="stats-icon bg-primary bg-opacity-10 text-primary">
                <i data-lucide="smartphone"></i>
            </div>
            <div>
                <h3 class="mb-0 fw-bold">{{ $phones }}</h3>
                <span class="text-muted small text-uppercase fw-semibold">Sản phẩm</span>
            </div>
        </div>
    </div>

    <!-- Cột 2 -->
    <div class="col-md-4">
        <div class="stats-card shadow-sm border-0">
            <div class="stats-icon bg-success bg-opacity-10 text-success">
                <i data-lucide="shopping-bag"></i>
            </div>
            <div>
                <h3 class="mb-0 fw-bold">{{ $orders }}</h3>
                <span class="text-muted small text-uppercase fw-semibold">Đơn hàng</span>
            </div>
        </div>
    </div>

    <!-- Cột 3 -->
    <div class="col-md-4">
        <div class="stats-card shadow-sm border-0">
            <div class="stats-icon bg-warning bg-opacity-10 text-warning">
                <i data-lucide="users"></i>
            </div>
            <div>
                <h3 class="mb-0 fw-bold">{{ $users }}</h3>
                <span class="text-muted small text-uppercase fw-semibold">Người dùng</span>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Biểu đồ tăng trưởng</h5>
        <button class="btn btn-sm btn-light border">Xuất báo cáo</button>
    </div>
    
    <div class="text-center py-5">
        <div class="mb-3">
            <i data-lucide="trending-up" size="48" class="text-muted opacity-25"></i>
        </div>
        <p class="text-muted">Biểu đồ thống kê chi tiết đang được cập nhật...</p>
    </div>
</div>

@endsection