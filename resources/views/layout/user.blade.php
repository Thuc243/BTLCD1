<!DOCTYPE html>
<html>
<head>
    <title>Phone Shop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background:#f5f5f5; }

        .card:hover{
            transform:scale(1.05);
            transition:0.3s;
        }

        .navbar-brand{
            font-weight:bold;
            font-size:20px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark bg-dark px-4">
    <span class="navbar-brand">📱 Phone Shop</span>

    <div>
        <a href="/" class="btn btn-light">Trang chủ</a>
        @auth
            <a href="/cart" class="btn btn-warning">🛒 Giỏ hàng</a>
            <a href="/orders" class="btn btn-info">📦 Đơn hàng</a>
            <span class="text-white me-3">{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button class="btn btn-danger" type="submit">Đăng xuất</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary">Đăng nhập</a>
            <a href="{{ route('register') }}" class="btn btn-secondary">Đăng ký</a>
        @endauth
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>