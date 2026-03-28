<!DOCTYPE html>
<html>
<head>

<title>Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.sidebar{
    width:220px;
    height:100vh;
    position:fixed;
    background:#212529;
    color:white;
    padding:20px;
}

.sidebar a{
    display:block;
    color:#ccc;
    padding:10px;
}

.sidebar a:hover{
    background:#0d6efd;
    color:white;
}

.content{
    margin-left:240px;
    padding:20px;
}
</style>

</head>

<body>

<div class="sidebar">
<h4>📊 Admin</h4>

<a href="/admin">Dashboard</a>
<a href="/admin/phones">Sản phẩm</a>
<a href="/admin/orders">Đơn hàng</a>
<a href="/admin/users">Khách hàng</a>

<hr style="border-color:#555">

<p class="text-muted small">{{ auth()->user()->name }}</p>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button class="btn btn-danger btn-sm w-100" type="submit">Đăng xuất</button>
</form>
</div>

<div class="content">
@yield('content')
</div>

</body>
</html>