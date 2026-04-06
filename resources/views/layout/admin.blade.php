<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hệ thống Quản trị - iPHONE STORE</title>

    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --sidebar-bg: #0f172a;
            --sidebar-color: #94a3b8;
            --sidebar-active: #ffffff;
            --sidebar-hover: #1e293b;
            --primary: #3b82f6;
            --bg-main: #f1f5f9;
        }

        body { 
            font-family: 'Inter', sans-serif;
            background: var(--bg-main);
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: var(--sidebar-bg);
            color: var(--sidebar-color);
            transition: 0.3s;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 100;
            padding: 20px;
        }

        .sidebar-brand {
            font-size: 20px;
            font-weight: 800;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 40px;
            text-decoration: none;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--sidebar-color);
            padding: 12px 15px;
            border-radius: 10px;
            text-decoration: none;
            margin-bottom: 5px;
            transition: 0.2s;
            font-weight: 500;
        }

        .nav-link:hover {
            background: var(--sidebar-hover);
            color: var(--sidebar-active);
        }

        .nav-link.active {
            background: var(--primary);
            color: white;
        }

        /* Content Area */
        .content {
            margin-left: 260px;
            flex: 1;
            padding: 30px;
        }

        .top-bar {
            background: white;
            padding: 15px 30px;
            border-bottom: 1px solid #e2e8f0;
            margin: -30px -30px 30px -30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }

        .stats-card {
            padding: 25px;
            border-radius: 15px;
            background: white;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .stats-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>

<div class="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
        <i data-lucide="shield-check" class="text-primary"></i>
        <span>ADMIN PANEL</span>
    </a>

    <div class="nav-menu">
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
            <i data-lucide="layout-dashboard"></i> Thống kê
        </a>
        <a href="{{ route('admin.phones') }}" class="nav-link {{ request()->is('admin/phones*') ? 'active' : '' }}">
            <i data-lucide="smartphone"></i> Sản phẩm
        </a>
        <a href="{{ route('admin.orders') }}" class="nav-link {{ request()->is('admin/orders*') ? 'active' : '' }}">
            <i data-lucide="shopping-bag"></i> Đơn hàng
        </a>
        <a href="{{ route('admin.users') }}" class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
            <i data-lucide="users"></i> Người dùng
        </a>
        
        <hr style="border-color: rgba(255,255,255,0.1)">

        <a href="{{ route('home') }}" class="nav-link">
            <i data-lucide="external-link"></i> Website
        </a>

        <form action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf
            <button class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-2">
                <i data-lucide="log-out" size="18"></i> Đăng xuất
            </button>
        </form>
    </div>
</div>

<div class="content">
    <div class="top-bar">
        <h5 class="mb-0 fw-bold">Xin chào, {{ auth()->user()->name }}</h5>
        <div class="text-muted small">{{ date('d/m/Y') }}</div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i data-lucide="check-circle" class="me-2" size="20"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    lucide.createIcons();
</script>
</body>
</html>