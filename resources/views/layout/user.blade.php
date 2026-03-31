<!DOCTYPE html>
<html>
<head>
    
    <title>Phone Shop</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #f5f5f5; }

        .header {
            background: #ffd400;
            padding: 10px 20px;
        }

        .logo {
            font-weight: bold;
            font-size: 22px;
        }

        .menu a {
            margin: 0 10px;
            color: black;
            font-weight: 500;
            text-decoration: none;
        }

        .menu a:hover {
            color: red;
        }

        .product-card {
            transition: 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .price {
            color: red;
            font-weight: bold;
        }

        .badge-hot {
            background: red;
            color: white;
            font-size: 12px;
            padding: 3px 6px;
            position: absolute;
            top: 10px;
            left: 10px;
        }
    </style>
</head>

<body>

<!-- HEADER -->
<div class="header d-flex justify-content-between align-items-center">

    <!-- LOGO -->
    <div class="d-flex align-items-center gap-3">

    <!-- HOME -->
    <a href="/" class="btn btn-dark btn-sm">
        🏠 Home
    </a>

    <!-- LOGO -->
    <div class="logo">📱 Phone Shop</div>

</div>

    <!-- SEARCH -->
    <form method="GET" action="/" class="d-flex w-50">
        <input type="text" name="keyword" class="form-control" placeholder="🔍 Bạn tìm gì...">
        <button class="btn btn-dark ms-2">Tìm</button>
    </form>

    <!-- USER + CART -->
    <div class="d-flex align-items-center gap-2">

        <!-- CART -->
        <a href="/cart" class="btn btn-dark">🛒</a>

        @auth
            <span class="fw-bold">👋 {{ auth()->user()->name }}</span>

            <form action="/logout" method="POST">
                @csrf
                <button class="btn btn-danger btn-sm">Đăng xuất</button>
            </form>
        @endauth

        @guest
            <a href="/login" class="btn btn-outline-dark btn-sm">Đăng nhập</a>
            <a href="/register" class="btn btn-dark btn-sm">Đăng ký</a>
        @endguest

    </div>

</div>

<!-- MENU HÃNG -->
<div class="bg-white p-2 text-center menu shadow-sm">

    @if(isset($categories) && count($categories))
        @foreach($categories as $c)
            <a href="/category/{{ $c->id }}">{{ $c->name }}</a>
        @endforeach
    @endif

</div>

<!-- CONTENT -->
<div class="container mt-3">
    @yield('content')
</div>

</body>
</html>