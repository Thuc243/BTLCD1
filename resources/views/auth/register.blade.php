<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng ký | iPHONE STORE</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --primary: #003b73;
            --secondary: #0074d9;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .register-container {
            width: 100%;
            max-width: 500px;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .brand-logo {
            font-weight: 800;
            font-size: 28px;
            color: var(--primary);
            text-align: center;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .form-control {
            height: 45px;
            border-radius: 10px;
            padding: 0 15px;
            border: 1px solid #ddd;
            background: rgba(255,255,255,0.5);
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(0, 116, 217, 0.1);
            border-color: var(--secondary);
        }

        .btn-register {
            background: var(--primary);
            color: white;
            height: 50px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 16px;
            width: 100%;
            border: none;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-register:hover {
            background: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 59, 115, 0.2);
            color: white;
        }

        .alert {
            border-radius: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="register-container">
    <div class="register-card">
        <div class="brand-logo mb-4">
            <i data-lucide="smartphone"></i>
            <span>iPHONE STORE</span>
        </div>
        
        <h5 class="text-center text-muted mb-4">Tham gia cùng chúng tôi hôm nay!</h5>

        @if($errors->any())
            <div class="alert alert-danger border-0">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label text-muted small fw-bold">Họ và tên</label>
                <input type="text" name="name" class="form-control" placeholder="Nguyễn Văn A" required value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label class="form-label text-muted small fw-bold">Email</label>
                <input type="email" name="email" class="form-control" placeholder="example@gmail.com" required value="{{ old('email') }}">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted small fw-bold">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                <div class="col-md-6 mb-4">
                    <label class="form-label text-muted small fw-bold">Xác nhận</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
                </div>
            </div>

            <button class="btn btn-register" type="submit">ĐĂNG KÝ TÀI KHOẢN</button>
        </form>

        <div class="mt-4 text-center">
            <p class="text-muted small">Đã có tài khoản? <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Đăng nhập</a></p>
            <hr>
            <a href="{{ route('home') }}" class="text-secondary small text-decoration-none d-flex align-items-center justify-content-center gap-1">
                <i data-lucide="arrow-left" size="14"></i> Quay về trang chủ
            </a>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();
</script>
</body>
</html>
