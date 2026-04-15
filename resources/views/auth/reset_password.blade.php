<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đặt lại mật khẩu | Phone Shop</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; min-height: 100vh; display: flex; align-items: center; justify-content: center; background: #0f0f1a; position: relative; overflow: hidden; }
        .bg-gradient { position: fixed; inset: 0; background: linear-gradient(135deg, #0f0f1a 0%, #1a1a2e 30%, #16213e 60%, #0f3460 100%); z-index: 0; }
        .bg-orb { position: fixed; border-radius: 50%; filter: blur(80px); opacity: 0.3; animation: float 8s ease-in-out infinite; z-index: 0; }
        .bg-orb-1 { width: 400px; height: 400px; background: #10b981; top: -100px; right: -100px; }
        .bg-orb-2 { width: 300px; height: 300px; background: #0f3460; bottom: -80px; left: -80px; animation-delay: -4s; }
        @keyframes float { 0%, 100% { transform: translateY(0) scale(1); } 50% { transform: translateY(-30px) scale(1.05); } }
        .auth-container { width: 100%; max-width: 440px; padding: 20px; position: relative; z-index: 1; }
        .auth-card { background: rgba(255,255,255,0.08); backdrop-filter: blur(30px); -webkit-backdrop-filter: blur(30px); padding: 44px 38px; border-radius: 24px; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 25px 50px rgba(0,0,0,0.3); }
        .auth-logo { text-align: center; margin-bottom: 32px; }
        .auth-logo-icon { width: 56px; height: 56px; border-radius: 16px; background: linear-gradient(135deg, #10b981, #34d399); display: flex; align-items: center; justify-content: center; margin: 0 auto 14px; color: white; }
        .auth-logo h2 { color: white; font-weight: 900; font-size: 24px; margin: 0; }
        .auth-logo p { color: rgba(255,255,255,0.5); font-size: 14px; margin-top: 6px; }
        .form-group { margin-bottom: 18px; }
        .form-label { display: block; color: rgba(255,255,255,0.7); font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; }
        .input-wrapper { position: relative; }
        .input-wrapper input { width: 100%; height: 50px; border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 0 16px 0 46px; font-size: 14px; font-family: inherit; background: rgba(255,255,255,0.06); color: white; transition: all 0.3s ease; outline: none; }
        .input-wrapper input::placeholder { color: rgba(255,255,255,0.3); }
        .input-wrapper input:focus { border-color: #10b981; background: rgba(255,255,255,0.1); box-shadow: 0 0 0 4px rgba(16,185,129,0.15); }
        .input-wrapper .input-icon { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: rgba(255,255,255,0.3); }
        .input-wrapper .toggle-pass { position: absolute; right: 16px; top: 50%; transform: translateY(-50%); color: rgba(255,255,255,0.3); cursor: pointer; background: none; border: none; padding: 0; }
        .input-wrapper .toggle-pass:hover { color: rgba(255,255,255,0.6); }
        .btn-submit { width: 100%; height: 52px; border: none; border-radius: 12px; background: linear-gradient(135deg, #10b981, #34d399); color: white; font-weight: 700; font-size: 15px; font-family: inherit; cursor: pointer; transition: all 0.3s ease; margin-top: 6px; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(16,185,129,0.4); }
        .auth-footer { text-align: center; margin-top: 24px; }
        .back-home { display: flex; align-items: center; justify-content: center; gap: 6px; color: rgba(255,255,255,0.4); font-size: 13px; text-decoration: none; transition: all 0.3s ease; }
        .back-home:hover { color: white; }
        .alert { border-radius: 12px; font-size: 13px; padding: 12px 16px; margin-bottom: 20px; }
        .alert-danger { background: rgba(239,68,68,0.15); border: 1px solid rgba(239,68,68,0.3); color: #fca5a5; }
        .alert-danger ul { margin-bottom: 0; padding-left: 18px; }
        .password-strength { height: 4px; border-radius: 4px; background: rgba(255,255,255,0.1); margin-top: 8px; overflow: hidden; }
        .password-strength-bar { height: 100%; border-radius: 4px; transition: all 0.3s ease; width: 0%; }
    </style>
</head>
<body>

<div class="bg-gradient"></div>
<div class="bg-orb bg-orb-1"></div>
<div class="bg-orb bg-orb-2"></div>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-logo">
            <div class="auth-logo-icon">
                <i data-lucide="lock" size="28"></i>
            </div>
            <h2>MẬT KHẨU MỚI</h2>
            <p>Tạo mật khẩu mới cho tài khoản của bạn</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Mật khẩu mới</label>
                <div class="input-wrapper">
                    <i data-lucide="lock" size="18" class="input-icon"></i>
                    <input type="password" name="password" id="password" placeholder="Tối thiểu 6 ký tự" required>
                    <button type="button" class="toggle-pass" onclick="togglePassword('password', 'eyeIcon1')">
                        <i data-lucide="eye" size="18" id="eyeIcon1"></i>
                    </button>
                </div>
                <div class="password-strength">
                    <div class="password-strength-bar" id="strengthBar"></div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Xác nhận mật khẩu</label>
                <div class="input-wrapper">
                    <i data-lucide="check-circle" size="18" class="input-icon"></i>
                    <input type="password" name="password_confirmation" id="password_confirm" placeholder="Nhập lại mật khẩu" required>
                    <button type="button" class="toggle-pass" onclick="togglePassword('password_confirm', 'eyeIcon2')">
                        <i data-lucide="eye" size="18" id="eyeIcon2"></i>
                    </button>
                </div>
            </div>

            <button class="btn-submit" type="submit">
                <i data-lucide="check" size="18"></i>
                ĐỔI MẬT KHẨU
            </button>
        </form>

        <div class="auth-footer">
            <a href="{{ route('login') }}" class="back-home mt-3">
                <i data-lucide="arrow-left" size="14"></i> Quay về đăng nhập
            </a>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();

    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.setAttribute('data-lucide', 'eye-off');
        } else {
            input.type = 'password';
            icon.setAttribute('data-lucide', 'eye');
        }
        lucide.createIcons();
    }

    // Password strength indicator
    document.getElementById('password').addEventListener('input', function() {
        const bar = document.getElementById('strengthBar');
        const len = this.value.length;
        if (len === 0) { bar.style.width = '0%'; bar.style.background = ''; }
        else if (len < 4) { bar.style.width = '25%'; bar.style.background = '#ef4444'; }
        else if (len < 6) { bar.style.width = '50%'; bar.style.background = '#f59e0b'; }
        else if (len < 8) { bar.style.width = '75%'; bar.style.background = '#3b82f6'; }
        else { bar.style.width = '100%'; bar.style.background = '#10b981'; }
    });
</script>
</body>
</html>
