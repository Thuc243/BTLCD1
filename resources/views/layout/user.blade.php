<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Phone Shop - Điện thoại chính hãng giá tốt</title>
    <meta name="description" content="Phone Shop - Cửa hàng điện thoại chính hãng, giá tốt nhất thị trường. iPhone, Samsung, Xiaomi, OPPO, Vivo.">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --primary: #1a1a2e;
            --primary-light: #16213e;
            --secondary: #0f3460;
            --accent: #e94560;
            --accent-light: #ff6b81;
            --gold: #f59e0b;
            --text-dark: #0f0f0f;
            --text-muted: #6b7280;
            --bg-body: #f4f6fb;
            --bg-white: #ffffff;
            --border-light: #e5e7eb;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.06);
            --shadow-md: 0 4px 12px rgba(0,0,0,0.08);
            --shadow-lg: 0 10px 30px rgba(0,0,0,0.1);
            --shadow-hover: 0 15px 40px rgba(0,0,0,0.15);
            --radius: 16px;
            --radius-sm: 10px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: var(--bg-body);
            color: var(--text-dark);
            -webkit-font-smoothing: antialiased;
        }

        /* ═══════════════════════════ HEADER ═══════════════════════════ */
        .main-header {
            background: rgba(255,255,255,0.92);
            backdrop-filter: saturate(180%) blur(20px);
            -webkit-backdrop-filter: saturate(180%) blur(20px);
            border-bottom: 1px solid rgba(0,0,0,0.06);
            position: sticky;
            top: 0;
            z-index: 1050;
            padding: 0;
            transition: var(--transition);
        }

        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            gap: 20px;
        }

        .logo {
            font-weight: 900;
            font-size: 22px;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
            transition: var(--transition);
        }

        .logo:hover { color: var(--accent); }

        .logo-icon {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--accent), #ff8a5c);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        /* Search Box */
        .search-wrapper {
            flex: 1;
            max-width: 520px;
            position: relative;
        }

        .search-wrapper input {
            width: 100%;
            height: 44px;
            border: 2px solid var(--border-light);
            border-radius: 50px;
            padding: 0 20px 0 46px;
            font-size: 14px;
            font-family: inherit;
            background: var(--bg-body);
            transition: var(--transition);
            outline: none;
        }

        .search-wrapper input:focus {
            border-color: var(--accent);
            background: white;
            box-shadow: 0 0 0 4px rgba(233,69,96,0.1);
        }

        .search-wrapper .search-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            pointer-events: none;
        }

        /* Header Actions */
        .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-icon {
            position: relative;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 2px solid var(--border-light);
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-dark);
            text-decoration: none;
            transition: var(--transition);
        }

        .btn-icon:hover {
            border-color: var(--accent);
            color: var(--accent);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .cart-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: var(--accent);
            color: white;
            font-size: 10px;
            font-weight: 700;
            min-width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
        }

        .btn-auth {
            height: 42px;
            padding: 0 22px;
            border-radius: 50px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            font-weight: 600;
            font-size: 13px;
            font-family: inherit;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: var(--transition);
            white-space: nowrap;
        }

        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(26,26,46,0.3);
            color: white;
        }

        .user-dropdown .dropdown-toggle {
            height: 42px;
            padding: 0 16px;
            border-radius: 50px;
            border: 2px solid var(--border-light);
            background: white;
            font-weight: 600;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .user-dropdown .dropdown-toggle:hover {
            border-color: var(--accent);
        }

        .user-dropdown .dropdown-toggle::after { margin-left: 4px; }

        .user-dropdown .dropdown-menu {
            border: none;
            box-shadow: var(--shadow-lg);
            border-radius: var(--radius-sm);
            padding: 8px;
            min-width: 200px;
        }

        .user-dropdown .dropdown-item {
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 14px;
            font-weight: 500;
            transition: var(--transition);
        }

        .user-dropdown .dropdown-item:hover { background: var(--bg-body); }

        .user-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), #ff8a5c);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 12px;
        }

        /* ═══════════════════════════ CATEGORY NAV ═══════════════════════════ */
        .category-strip {
            background: white;
            border-bottom: 1px solid var(--border-light);
            padding: 0;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .category-strip::-webkit-scrollbar { display: none; }

        .category-strip-inner {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            padding: 8px 0;
            min-width: max-content;
        }

        .cat-link {
            padding: 8px 18px;
            border-radius: 50px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-muted);
            transition: var(--transition);
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .cat-link:hover, .cat-link.active {
            background: var(--primary);
            color: white;
        }

        /* ═══════════════════════════ SECTION TITLES ═══════════════════════════ */
        .section-heading {
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-heading .icon-box {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-shrink: 0;
        }

        .section-heading::after {
            content: '';
            flex: 1;
            height: 2px;
            background: linear-gradient(to right, var(--border-light), transparent);
            margin-left: 10px;
        }

        /* ═══════════════════════════ PAGINATION ═══════════════════════════ */
        .custom-pagination {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 14px;
            margin-top: 36px;
            padding-top: 28px;
            border-top: 1px solid var(--border-light);
        }

        .pagination-info {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .pagination-list {
            display: flex;
            align-items: center;
            gap: 6px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .page-btn span,
        .page-btn a {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 6px;
            border-radius: 10px;
            border: 2px solid var(--border-light);
            background: var(--bg-white);
            color: var(--text-dark);
            font-weight: 600;
            font-size: 14px;
            font-family: inherit;
            text-decoration: none;
            transition: var(--transition);
            cursor: pointer;
            line-height: 1;
        }

        .page-btn a:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(26,26,46,0.2);
        }

        .page-btn.active span {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-color: var(--primary);
            font-weight: 700;
            box-shadow: 0 4px 14px rgba(26,26,46,0.25);
        }

        .page-btn.disabled span {
            background: var(--bg-body);
            color: #c5c9d2;
            border-color: var(--border-light);
            cursor: not-allowed;
        }

        .page-btn.dots span {
            border: none;
            background: transparent;
            min-width: 30px;
            font-size: 16px;
            color: var(--text-muted);
            cursor: default;
        }

        .page-btn svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        @media (max-width: 576px) {
            .pagination-list { gap: 4px; }
            .page-btn span, .page-btn a {
                min-width: 34px;
                height: 34px;
                font-size: 13px;
                border-radius: 8px;
            }
        }

        /* ═══════════════════════════ TOAST ═══════════════════════════ */
        .toast-container {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 9999;
        }

        .custom-toast {
            background: white;
            border-radius: var(--radius-sm);
            padding: 16px 24px;
            box-shadow: var(--shadow-lg);
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            font-size: 14px;
            border-left: 4px solid #10b981;
            animation: slideInRight 0.4s ease-out;
        }

        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        /* ═══════════════════════════ FOOTER ═══════════════════════════ */
        .main-footer {
            background: var(--primary);
            color: rgba(255,255,255,0.7);
            padding: 60px 0 0;
            margin-top: 60px;
        }

        .footer-brand {
            font-weight: 900;
            font-size: 24px;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
        }

        .footer-desc {
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .footer-title {
            font-weight: 700;
            font-size: 16px;
            color: white;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li { margin-bottom: 10px; }

        .footer-links a {
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 14px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-links a:hover {
            color: white;
            padding-left: 4px;
        }

        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 14px;
            font-size: 14px;
        }

        .footer-contact-item i { color: var(--accent); margin-top: 2px; }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding: 20px 0;
            margin-top: 40px;
            text-align: center;
            font-size: 13px;
        }

        /* ═══════════════════════════ SCROLL TO TOP ═══════════════════════════ */
        .scroll-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), #ff8a5c);
            color: white;
            border: none;
            display: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 999;
            box-shadow: 0 4px 20px rgba(233,69,96,0.4);
            transition: var(--transition);
        }

        .scroll-top:hover { transform: translateY(-4px); }
        .scroll-top.show { display: flex; }

        /* ═══════════════════════════ RESPONSIVE ═══════════════════════════ */

        /* Mobile Search Bar */
        .mobile-search {
            display: none;
            background: white;
            border-bottom: 1px solid var(--border-light);
            padding: 8px 16px;
        }

        .mobile-search form {
            position: relative;
        }

        .mobile-search input {
            width: 100%;
            height: 40px;
            border: 2px solid var(--border-light);
            border-radius: 50px;
            padding: 0 16px 0 40px;
            font-size: 14px;
            font-family: inherit;
            background: var(--bg-body);
            transition: var(--transition);
            outline: none;
        }

        .mobile-search input:focus {
            border-color: var(--accent);
            background: white;
            box-shadow: 0 0 0 3px rgba(233,69,96,0.1);
        }

        .mobile-search .search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            pointer-events: none;
        }

        @media (max-width: 768px) {
            .search-wrapper { display: none; }
            .mobile-search { display: block; }
            .header-inner { padding: 10px 0; }
            .logo { font-size: 17px; }
            .logo-icon { width: 34px; height: 34px; border-radius: 8px; }
            .btn-icon { width: 38px; height: 38px; }
            .btn-auth { height: 38px; padding: 0 16px; font-size: 12px; }
            .user-dropdown .dropdown-toggle { height: 38px; padding: 0 12px; font-size: 12px; }
            .header-actions { gap: 6px; }

            /* Category strip mobile */
            .category-strip-inner { justify-content: flex-start; padding: 6px 0; }
            .cat-link { padding: 6px 14px; font-size: 12px; }

            /* Footer mobile */
            .main-footer { padding: 36px 0 0; margin-top: 40px; }
            .footer-brand { font-size: 20px; }
            .footer-title { margin-bottom: 14px; font-size: 14px; }
            .footer-desc { font-size: 13px; }
            .footer-links a { font-size: 13px; }
            .footer-contact-item { font-size: 13px; }
            .footer-bottom { font-size: 12px; padding: 16px 0; margin-top: 24px; }

            /* Section headings */
            .section-heading { font-size: 18px; margin-bottom: 16px; }
            .section-heading .icon-box { width: 34px; height: 34px; border-radius: 8px; }

            /* Main content */
            .container.py-4 { padding-top: 12px !important; padding-bottom: 12px !important; }

            /* Toast on mobile */
            .toast-container { right: 12px; left: 12px; top: 70px; }
            .custom-toast { padding: 12px 16px; font-size: 13px; }

            /* Scroll to top - mobile position */
            .scroll-top { bottom: 20px; right: 16px; width: 40px; height: 40px; }
        }

        @media (max-width: 576px) {
            .logo span { font-size: 15px; }
            .logo-icon { width: 30px; height: 30px; }
            .btn-auth span { display: none; }
            .btn-auth { padding: 0 12px; width: 38px; justify-content: center; }
        }

        /* ═══════════════════════════ LIVE SEARCH AJAX ═══════════════════════════ */
        .search-results-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: white;
            border-radius: var(--radius-sm);
            box-shadow: var(--shadow-lg);
            margin-top: 8px;
            z-index: 1100;
            max-height: 400px;
            overflow-y: auto;
            display: none;
            border: 1px solid var(--border-light);
        }

        .search-results-dropdown.active {
            display: block;
        }

        .search-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            text-decoration: none;
            color: var(--text-dark);
            border-bottom: 1px solid var(--border-light);
            transition: var(--transition);
        }

        .search-item:last-child {
            border-bottom: none;
        }

        .search-item:hover {
            background: var(--bg-body);
        }

        .search-item img {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            object-fit: cover;
        }

        .search-item-info {
            flex: 1;
        }

        .search-item-name {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 4px;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .search-item-price {
            font-size: 13px;
            font-weight: 700;
            color: var(--accent);
        }
        
        .search-loading {
            padding: 16px;
            text-align: center;
            color: var(--text-muted);
            font-size: 13px;
        }

        .search-no-result {
            padding: 16px;
            text-align: center;
            color: var(--text-muted);
            font-size: 13px;
        }
    </style>
</head>

<body>

<!-- TOAST NOTIFICATIONS -->
@if(session('cart_success'))
<div class="toast-container">
    <div class="custom-toast" id="cartToast">
        <i data-lucide="check-circle" size="20" style="color: #10b981;"></i>
        <span>{{ session('cart_success') }}</span>
    </div>
</div>
@endif

@if(session('review_success'))
<div class="toast-container">
    <div class="custom-toast" id="reviewToast">
        <i data-lucide="check-circle" size="20" style="color: #10b981;"></i>
        <span>{{ session('review_success') }}</span>
    </div>
</div>
@endif

<!-- HEADER -->
<header class="main-header">
    <div class="container">
        <div class="header-inner">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="logo">
                <div class="logo-icon">
                    <i data-lucide="smartphone" size="20"></i>
                </div>
                <span>PHONE SHOP</span>
            </a>

            <!-- Search -->
            <form method="GET" action="{{ route('home') }}" class="search-wrapper" style="position: relative;">
                <i data-lucide="search" size="18" class="search-icon"></i>
                <input type="text" name="keyword" id="desktopSearchInput" autocomplete="off" placeholder="Tìm kiếm iPhone, Samsung, Xiaomi..." value="{{ request('keyword') }}">
                <div class="search-results-dropdown" id="desktopSearchResults"></div>
            </form>

            <!-- Actions -->
            <div class="header-actions">
                <a href="{{ route('cart') }}" class="btn-icon" title="Giỏ hàng">
                    <i data-lucide="shopping-bag" size="18"></i>
                    @if(session('cart'))
                        <span class="cart-badge">{{ count(session('cart')) }}</span>
                    @endif
                </a>

                @auth
                    <div class="dropdown user-dropdown">
                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                            <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @if(auth()->user()->role == 'admin')
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    <i data-lucide="shield" size="16" class="me-2"></i>Quản trị
                                </a></li>
                            @endif
                            @if(auth()->user()->role == 'shipper' || auth()->user()->role == 'admin')
                                <li><a class="dropdown-item" href="{{ route('shipper.orders') }}">
                                    <i data-lucide="truck" size="16" class="me-2"></i>Giao hàng (Shipper)
                                </a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('orders') }}">
                                <i data-lucide="package" size="16" class="me-2"></i>Đơn mua của tôi
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger">
                                        <i data-lucide="log-out" size="16" class="me-2"></i>Đăng xuất
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn-auth">
                        <i data-lucide="user" size="16"></i>
                        <span>Đăng nhập</span>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>

<!-- MOBILE SEARCH -->
<div class="mobile-search">
    <form method="GET" action="{{ route('home') }}" style="position: relative;">
        <i data-lucide="search" size="16" class="search-icon"></i>
        <input type="text" name="keyword" id="mobileSearchInput" autocomplete="off" placeholder="Tìm kiếm sản phẩm..." value="{{ request('keyword') }}">
        <div class="search-results-dropdown" id="mobileSearchResults"></div>
    </form>
</div>

<!-- CATEGORY STRIP -->
<nav class="category-strip">
    <div class="container">
        <div class="category-strip-inner">
            <a href="{{ route('home') }}" class="cat-link {{ !request('category') && request()->is('/') ? 'active' : '' }}">
                <i data-lucide="layers" size="14"></i> Tất cả
            </a>
            @if(isset($categories))
                @foreach($categories as $c)
                    <a href="{{ route('category', $c->id) }}" class="cat-link {{ request()->is('category/'.$c->id) ? 'active' : '' }}">
                        {{ $c->name }}
                    </a>
                @endforeach
            @endif
        </div>
    </div>
</nav>

<!-- CONTENT -->
<main class="container py-4">
    @yield('content')
</main>

<!-- FOOTER -->
<footer class="main-footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="footer-brand">
                    <div class="logo-icon">
                        <i data-lucide="smartphone" size="18"></i>
                    </div>
                    PHONE SHOP
                </div>
                <p class="footer-desc">
                    Cửa hàng điện thoại chính hãng uy tín hàng đầu Việt Nam. 
                    Cam kết 100% sản phẩm nguyên seal, bảo hành chính hãng với giá tốt nhất thị trường.
                </p>
            </div>
            <div class="col-lg-2 col-md-4">
                <h6 class="footer-title">Liên kết</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}"><i data-lucide="chevron-right" size="14"></i>Trang chủ</a></li>
                    <li><a href="{{ route('cart') }}"><i data-lucide="chevron-right" size="14"></i>Giỏ hàng</a></li>
                    <li><a href="{{ route('orders') }}"><i data-lucide="chevron-right" size="14"></i>Đơn hàng</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-4">
                <h6 class="footer-title">Danh mục</h6>
                <ul class="footer-links">
                    @if(isset($categories))
                        @foreach($categories->take(5) as $c)
                        <li><a href="{{ route('category', $c->id) }}"><i data-lucide="chevron-right" size="14"></i>{{ $c->name }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="col-lg-4 col-md-4">
                <h6 class="footer-title">Liên hệ</h6>
                <div class="footer-contact-item">
                    <i data-lucide="map-pin" size="16"></i>
                    <span>123 Đường Nguyễn Huệ, Quận 1, TP.HCM</span>
                </div>
                <div class="footer-contact-item">
                    <i data-lucide="phone" size="16"></i>
                    <span>0337 312 919</span>
                </div>
                <div class="footer-contact-item">
                    <i data-lucide="mail" size="16"></i>
                    <span>contact@phoneshop.vn</span>
                </div>
                <div class="footer-contact-item">
                    <i data-lucide="clock" size="16"></i>
                    <span>8:00 - 21:00 (Thứ 2 - CN)</span>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            © 2026 PHONE SHOP. All rights reserved. Designed with ❤️ by Mai Anh Thức.
        </div>
    </div>
</footer>

<!-- SCROLL TO TOP -->
<button class="scroll-top" id="scrollTopBtn" onclick="window.scrollTo({top:0,behavior:'smooth'})">
    <i data-lucide="chevron-up" size="22"></i>
</button>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    lucide.createIcons();

    // Scroll to top button
    window.addEventListener('scroll', () => {
        const btn = document.getElementById('scrollTopBtn');
        if (window.scrollY > 400) btn.classList.add('show');
        else btn.classList.remove('show');
    });

    // Auto-hide toast
    document.querySelectorAll('.custom-toast').forEach(toast => {
        setTimeout(() => {
            toast.style.transition = 'all 0.4s ease';
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => toast.parentElement.remove(), 400);
        }, 3000);
    });

    // ════════════════════ LIVE SEARCH AJAX ════════════════════
    function initLiveSearch(inputId, resultsId) {
        const input = document.getElementById(inputId);
        const resultsBox = document.getElementById(resultsId);
        if(!input || !resultsBox) return;

        let debounceTimer;

        input.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            const keyword = this.value.trim();

            if(keyword.length < 2) {
                resultsBox.classList.remove('active');
                return;
            }

            resultsBox.classList.add('active');
            resultsBox.innerHTML = '<div class="search-loading">Đang tìm...</div>';

            debounceTimer = setTimeout(() => {
                fetch(`{{ route('search.ajax') }}?keyword=${encodeURIComponent(keyword)}`)
                    .then(res => res.json())
                    .then(data => {
                        resultsBox.innerHTML = '';
                        if(data.length === 0) {
                            resultsBox.innerHTML = `<div class="search-no-result">Không tìm thấy sản phẩm nào cho "${keyword}"</div>`;
                            return;
                        }

                        data.forEach(item => {
                            const formattedPrice = new Intl.NumberFormat('vi-VN').format(item.price) + 'đ';
                            let imageUrl = item.image;
                            if (imageUrl && !imageUrl.startsWith('http')) {
                                imageUrl = `{{ asset('uploads') }}/${item.image}`;
                            } else if (!imageUrl) {
                                imageUrl = 'https://via.placeholder.com/40';
                            }
                            
                            resultsBox.innerHTML += `
                                <a href="{{ url('/product') }}/${item.id}" class="search-item">
                                    <img src="${imageUrl}" alt="${item.name}">
                                    <div class="search-item-info">
                                        <div class="search-item-name">${item.name}</div>
                                        <div class="search-item-price">${formattedPrice}</div>
                                    </div>
                                </a>
                            `;
                        });
                    })
                    .catch(err => {
                        console.error('Lỗi tìm kiếm:', err);
                        resultsBox.innerHTML = '<div class="search-no-result text-danger">Có lỗi xảy ra. Vui lòng thử lại.</div>';
                    });
            }, 300); // Đợi 300ms sau khi ngừng gõ
        });

        // Ẩn khi click ra ngoài
        document.addEventListener('click', function(e) {
            if(!input.contains(e.target) && !resultsBox.contains(e.target)) {
                resultsBox.classList.remove('active');
            }
        });
        
        // Hiện lại khi focus vào ô tìm kiếm nếu có từ khóa
        input.addEventListener('focus', function() {
            if(this.value.trim().length >= 2) {
                resultsBox.classList.add('active');
            }
        });
    }

    initLiveSearch('desktopSearchInput', 'desktopSearchResults');
    initLiveSearch('mobileSearchInput', 'mobileSearchResults');
</script>
@yield('scripts')
</body>
</html>