<!DOCTYPE html>
<html>
<head>

<title>Phone Shop</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f4f6f9;
}

.navbar{
box-shadow:0 2px 10px rgba(0,0,0,0.2);
}

.card{
border-radius:12px;
transition:0.3s;
}

.card:hover{
transform:scale(1.05);
}

.price{
color:red;
font-weight:bold;
font-size:18px;
}

.banner{
padding:80px;
background:linear-gradient(120deg,#007bff,#00c6ff);
color:white;
text-align:center;
border-radius:10px;
}

</style>

</head>

<body>

<nav class="navbar navbar-dark bg-dark">

<div class="container">

<a class="navbar-brand fw-bold" href="/">
📱 Phone Shop
</a>

<div>

<a class="btn btn-light me-2" href="/phones">
Danh sách
</a>

<a class="btn btn-success" href="/phones/create">
Thêm điện thoại
</a>

</div>

</div>

</nav>

<div class="container mt-4">

@yield('content')

</div>

</body>
</html>