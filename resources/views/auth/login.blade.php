<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập | Phone Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: #f5f5f5;
        }
        .login-box {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .login-box h3 {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h3>📱 Phone Shop - Đăng nhập</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Mật khẩu</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
        </div>

        <button class="btn btn-primary w-100" type="submit">Đăng nhập</button>
    </form>

    <hr>

    <p class="text-center">Chưa có tài khoản? <a href="/register">Đăng ký ngay</a></p>
</div>

</body>
</html>
