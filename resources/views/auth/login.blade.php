<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập | Phone Shop</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0f0f1a;
            position: relative;
            overflow: hidden;
        }

        /* Animated Background */
        .bg-gradient {
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, #0f0f1a 0%, #1a1a2e 30%, #16213e 60%, #0f3460 100%);
            z-index: 0;
        }

        .bg-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.3;
            animation: float 8s ease-in-out infinite;
            z-index: 0;
        }

        .bg-orb-1 {
            width: 400px; height: 400px;
            background: #e94560;
            top: -100px; left: -100px;
            animation-delay: 0s;
        }

        .bg-orb-2 {
            width: 300px; height: 300px;
            background: #0f3460;
            bottom: -80px; right: -80px;
            animation-delay: -4s;
        }

        .bg-orb-3 {
            width: 200px; height: 200px;
            background: #f59e0b;
            top: 50%; left: 60%;
            animation-delay: -2s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-30px) scale(1.05); }
        }

        .auth-container {
            width: 100%;
            max-width: 440px;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .auth-card {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            padding: 44px 38px;
            border-radius: 24px;
            border: 1px solid rgba(255,255,255,0.1);
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 32px;
        }

        .auth-logo-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: linear-gradient(135deg, #e94560, #ff8a5c);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            color: white;
        }

        .auth-logo h2 {
            color: white;
            font-weight: 900;
            font-size: 24px;
            margin: 0;
        }

        .auth-logo p {
            color: rgba(255,255,255,0.5);
            font-size: 14px;
            margin-top: 6px;
        }

        .form-group { margin-bottom: 18px; }

        .form-label {
            display: block;
            color: rgba(255,255,255,0.7);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper input {
            width: 100%;
            height: 50px;
            border: 2px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 0 16px 0 46px;
            font-size: 14px;
            font-family: inherit;
            background: rgba(255,255,255,0.06);
            color: white;
            transition: all 0.3s ease;
            outline: none;
        }

        .input-wrapper input::placeholder { color: rgba(255,255,255,0.3); }

        .input-wrapper input:focus {
            border-color: #e94560;
            background: rgba(255,255,255,0.1);
            box-shadow: 0 0 0 4px rgba(233,69,96,0.15);
        }

        .input-wrapper .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.3);
        }

        .input-wrapper .toggle-pass {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.3);
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
        }

        .input-wrapper .toggle-pass:hover { color: rgba(255,255,255,0.6); }

        .btn-submit {
            width: 100%;
            height: 52px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #e94560, #ff6b81);
            color: white;
            font-weight: 700;
            font-size: 15px;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(233,69,96,0.4);
        }

        .auth-footer {
            text-align: center;
            margin-top: 24px;
        }

        .auth-footer p {
            color: rgba(255,255,255,0.5);
            font-size: 13px;
        }

        .auth-footer a {
            color: #e94560;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .auth-footer a:hover { color: #ff8a5c; }

        .auth-divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
        }

        .auth-divider::before, .auth-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255,255,255,0.1);
        }

        .auth-divider span {
            padding: 0 16px;
            color: rgba(255,255,255,0.3);
            font-size: 12px;
        }

        .back-home {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            color: rgba(255,255,255,0.4);
            font-size: 13px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .back-home:hover { color: white; }

        .alert {
            background: rgba(239,68,68,0.15);
            border: 1px solid rgba(239,68,68,0.3);
            border-radius: 12px;
            color: #fca5a5;
            font-size: 13px;
            padding: 12px 16px;
            margin-bottom: 20px;
        }

        .alert ul { margin-bottom: 0; padding-left: 18px; }
    </style>
</head>
<body>

<div class="bg-gradient"></div>
<div class="bg-orb bg-orb-1"></div>
<div class="bg-orb bg-orb-2"></div>
<div class="bg-orb bg-orb-3"></div>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-logo">
            <div class="auth-logo-icon">
                <i data-lucide="smartphone" size="28"></i>
            </div>
            <h2>PHONE SHOP</h2>
            <p>Chào mừng bạn quay trở lại!</p>
        </div>

        @if($errors->any())
            <div class="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Email đăng nhập</label>
                <div class="input-wrapper">
                    <i data-lucide="mail" size="18" class="input-icon"></i>
                    <input type="email" name="email" placeholder="example@gmail.com" required value="{{ old('email') }}">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Mật khẩu</label>
                <div class="input-wrapper">
                    <i data-lucide="lock" size="18" class="input-icon"></i>
                    <input type="password" name="password" id="password" placeholder="••••••••" required>
                    <button type="button" class="toggle-pass" onclick="togglePassword()">
                        <i data-lucide="eye" size="18" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <button class="btn-submit" type="submit">
                <i data-lucide="log-in" size="18"></i>
                ĐĂNG NHẬP
            </button>
        </form>

        <div class="auth-footer">
            <div class="auth-divider"><span>hoặc</span></div>
            <p>Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký ngay</a></p>
            <a href="{{ route('home') }}" class="back-home mt-3">
                <i data-lucide="arrow-left" size="14"></i> Quay về trang chủ
            </a>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();

    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('eyeIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.setAttribute('data-lucide', 'eye-off');
        } else {
            input.type = 'password';
            icon.setAttribute('data-lucide', 'eye');
        }
        lucide.createIcons();
    }
</script>
</body>
</html>
