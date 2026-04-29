<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản trị - Phone Shop</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --sidebar-bg: #0f172a;
            --sidebar-hover: #1e293b;
            --sidebar-active: #3b82f6;
            --sidebar-text: #94a3b8;
            --sidebar-text-active: #ffffff;
            --bg-main: #f1f5f9;
            --card-bg: #ffffff;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --primary: #3b82f6;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --radius: 14px;
            --shadow: 0 1px 3px rgba(0,0,0,0.06);
            --transition: all 0.3s ease;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: var(--bg-main);
            display: flex;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        /* ═══════════ SIDEBAR ═══════════ */
        .sidebar {
            width: 260px;
            background: var(--sidebar-bg);
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 100;
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
            transition: var(--transition);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            margin-bottom: 36px;
            padding: 0 8px;
        }

        .sidebar-brand-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .sidebar-brand span {
            font-weight: 800;
            font-size: 18px;
            color: white;
        }

        .sidebar-section {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #475569;
            padding: 0 12px;
            margin: 20px 0 10px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--sidebar-text);
            padding: 11px 14px;
            border-radius: 10px;
            text-decoration: none;
            margin-bottom: 4px;
            transition: var(--transition);
            font-weight: 500;
            font-size: 14px;
            position: relative;
        }

        .nav-item:hover {
            background: var(--sidebar-hover);
            color: var(--sidebar-text-active);
        }

        .nav-item.active {
            background: var(--sidebar-active);
            color: white;
            font-weight: 600;
        }

        .nav-badge {
            margin-left: auto;
            background: var(--danger);
            color: white;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 50px;
        }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 16px;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        /* ═══════════ CONTENT ═══════════ */
        .main-content {
            margin-left: 260px;
            flex: 1;
            min-height: 100vh;
        }

        .topbar {
            background: var(--card-bg);
            padding: 16px 32px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-title {
            font-weight: 700;
            font-size: 17px;
            color: var(--text-dark);
        }

        .topbar-date {
            font-size: 13px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .content-body {
            padding: 28px 32px;
        }

        /* ═══════════ CARDS & TABLES ═══════════ */
        .card {
            border: none;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            background: var(--card-bg);
        }

        .stats-card {
            padding: 24px;
            border-radius: var(--radius);
            background: var(--card-bg);
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 18px;
            transition: var(--transition);
        }

        .stats-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }

        .stats-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stats-info h3 {
            font-size: 24px;
            font-weight: 800;
            margin: 0;
            color: var(--text-dark);
        }

        .stats-info span {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--text-muted);
            letter-spacing: 0.5px;
        }

        .table { margin: 0; }

        .table thead {
            background: #f8fafc;
        }

        .table th {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            padding: 14px 20px;
            border-bottom: 1px solid var(--border);
        }

        .table td {
            padding: 14px 20px;
            vertical-align: middle;
            border-color: var(--border);
            font-size: 14px;
        }

        /* ═══════════ ALERTS ═══════════ */
        .alert-success {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            border-radius: var(--radius);
            font-weight: 500;
            font-size: 14px;
        }

        /* ═══════════ RESPONSIVE ═══════════ */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

<div class="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
        <div class="sidebar-brand-icon">
            <i data-lucide="shield-check" size="20"></i>
        </div>
        <span>ADMIN</span>
    </a>

    <div class="sidebar-section">Tổng quan</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->is('admin') ? 'active' : '' }}">
        <i data-lucide="bar-chart-3" size="18"></i> Dashboard
    </a>
    <a href="{{ route('admin.revenue') }}" class="nav-item {{ request()->is('admin/revenue') ? 'active' : '' }}">
        <i data-lucide="pie-chart" size="18"></i> Báo cáo doanh thu
    </a>

    <div class="sidebar-section">Quản lý</div>
    <a href="{{ route('admin.phones') }}" class="nav-item {{ request()->is('admin/phones*') ? 'active' : '' }}">
        <i data-lucide="smartphone" size="18"></i> Sản phẩm
    </a>
    <a href="{{ route('admin.categories') }}" class="nav-item {{ request()->is('admin/categories*') ? 'active' : '' }}">
        <i data-lucide="folder" size="18"></i> Danh mục
    </a>
    <a href="{{ route('admin.orders') }}" class="nav-item {{ request()->is('admin/orders*') ? 'active' : '' }}">
        <i data-lucide="shopping-bag" size="18"></i> Đơn hàng
        @php $pendingCount = \App\Models\Order::where('status','pending')->count(); @endphp
        @if($pendingCount > 0)
            <span class="nav-badge">{{ $pendingCount }}</span>
        @endif
    </a>
    <a href="{{ route('admin.users') }}" class="nav-item {{ request()->is('admin/users*') ? 'active' : '' }}">
        <i data-lucide="users" size="18"></i> Người dùng
    </a>

    <div class="sidebar-footer">
        <a href="{{ route('home') }}" class="nav-item">
            <i data-lucide="external-link" size="18"></i> Xem website
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="nav-item w-100 border-0" style="background: transparent; cursor: pointer; color: var(--danger);">
                <i data-lucide="log-out" size="18"></i> Đăng xuất
            </button>
        </form>
    </div>
</div>

<div class="main-content">
    <div class="topbar">
        <div class="topbar-title">Xin chào, {{ auth()->user()->name }} 👋</div>
        <div class="topbar-date">
            <i data-lucide="calendar" size="14"></i>
            {{ date('d/m/Y') }}
        </div>
    </div>

    <div class="content-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i data-lucide="check-circle" class="me-2" size="18"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>lucide.createIcons();</script>
</body>
</html>