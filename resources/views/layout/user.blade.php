<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Phone Shop Premium</title>

    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Lucide Icons (CDN) -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --primary: #003b73;
            --secondary: #0074d9;
            --accent: #ffd400;
            --text-dark: #1a1a1a;
            --bg-light: #f8f9fa;
        }

        body { 
            font-family: 'Inter', sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
        }

        /* Header */
        .glass-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 12px 0;
        }

        .logo {
            font-weight: 800;
            font-size: 24px;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .search-box {
            position: relative;
            max-width: 500px;
            width: 100%;
        }

        .search-box input {
            border-radius: 25px;
            padding-left: 45px;
            border: 1px solid #ddd;
            height: 45px;
            transition: 0.3s;
        }

        .search-box input:focus {
            box-shadow: 0 0 0 3px rgba(0, 116, 217, 0.1);
            border-color: var(--secondary);
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }

        /* Mega Menu */
        .category-nav {
            background: white;
            border-bottom: 1px solid #eee;
            padding: 10px 0;
        }

        .category-nav a {
            color: #555;
            text-decoration: none;
            font-weight: 500;
            margin: 0 15px;
            transition: 0.2s;
            font-size: 14px;
            text-transform: uppercase;
        }

        .category-nav a:hover {
            color: var(--secondary);
        }

        /* Cart Badge */
        .btn-cart {
            position: relative;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }

        .btn-cart:hover {
            background: var(--secondary);
            transform: scale(1.05);
            color: white;
        }

        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ff4d4d;
            color: white;
            font-size: 10px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            border: 2px solid white;
        }

        /* Banner */
        .premium-banner {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        /* General UI */
        .section-title {
            font-weight: 700;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .footer {
            background: #1a1a1a;
            color: #aaa;
            padding: 50px 0;
            margin-top: 50px;
        }
    </style>
</head>

<body>

<!-- HEADER -->
<header class="glass-header">
    <div class="container d-flex justify-content-between align-items-center">
        
        <!-- LOGO -->
        <a href="{{ route('home') }}" class="logo">
            <i data-lucide="smartphone"></i>
            <span>iPHONE STORE</span>
        </a>

        <!-- SEARCH -->
        <form method="GET" action="{{ route('home') }}" class="search-box d-none d-md-block">
            <i data-lucide="search" size="18"></i>
            <input type="text" name="keyword" class="form-control" placeholder="Bạn cần tìm iPhone, Samsung..." value="{{ request('keyword') }}">
        </form>

        <!-- ACTIONS -->
        <div class="d-flex align-items-center gap-3">
            
            <a href="{{ route('cart') }}" class="btn-cart">
                <i data-lucide="shopping-cart" size="20"></i>
                @if(session('cart'))
                    <span class="cart-count">{{ count(session('cart')) }}</span>
                @endif
            </a>

            <div class="dropdown">
                @auth
                    <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Chào, {{ auth()->user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @if(auth()->user()->role == 'admin')
                            <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Hệ thống quản trị</a></li>
                        @endif
                        <li><a class="dropdown-item" href="{{ route('orders') }}">Đơn hàng của tôi</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item text-danger">Đăng xuất</button>
                            </form>
                        </li>
                    </ul>
                @else
                    <a href="{{ route('login') }}" class="btn btn-dark px-4">Đăng nhập</a>
                @endauth
            </div>

        </div>
    </div>
</header>

<!-- CATEGORY NAV -->
<nav class="category-nav d-none d-md-block">
    <div class="container d-flex justify-content-center">
        <a href="{{ route('home') }}">Tất cả</a>
        @if(isset($categories))
            @foreach($categories as $c)
                <a href="{{ route('category', $c->id) }}">{{ $c->name }}</a>
            @endforeach
        @endif
    </div>
</nav>

<!-- CONTENT -->
<main class="container py-4">
    @yield('content')
</main>

<footer class="footer">
    <div class="container text-center">
        <p class="mb-2">© 2026 iPHONE STORE - Premium Experience</p>
        <span class="text-muted small">Designed with ❤️ for premium customers.</span>
    </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    lucide.createIcons();
</script>
</body>
</html>