<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Xác thực Email | Phone Shop</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; min-height: 100vh; display: flex; align-items: center; justify-content: center; background: #0f0f1a; position: relative; overflow: hidden; }
        .bg-gradient { position: fixed; inset: 0; background: linear-gradient(135deg, #0f0f1a 0%, #1a1a2e 30%, #16213e 60%, #0f3460 100%); z-index: 0; }
        .bg-orb { position: fixed; border-radius: 50%; filter: blur(80px); opacity: 0.3; animation: float 8s ease-in-out infinite; z-index: 0; }
        .bg-orb-1 { width: 400px; height: 400px; background: #8b5cf6; top: -100px; right: -100px; }
        .bg-orb-2 { width: 300px; height: 300px; background: #e94560; bottom: -80px; left: -80px; animation-delay: -4s; }
        .bg-orb-3 { width: 200px; height: 200px; background: #f59e0b; top: 60%; left: 30%; animation-delay: -2s; }
        @keyframes float { 0%, 100% { transform: translateY(0) scale(1); } 50% { transform: translateY(-30px) scale(1.05); } }
        .auth-container { width: 100%; max-width: 440px; padding: 20px; position: relative; z-index: 1; }
        .auth-card { background: rgba(255,255,255,0.08); backdrop-filter: blur(30px); -webkit-backdrop-filter: blur(30px); padding: 44px 38px; border-radius: 24px; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 25px 50px rgba(0,0,0,0.3); }
        .auth-logo { text-align: center; margin-bottom: 32px; }
        .auth-logo-icon { width: 56px; height: 56px; border-radius: 16px; background: linear-gradient(135deg, #8b5cf6, #a78bfa); display: flex; align-items: center; justify-content: center; margin: 0 auto 14px; color: white; }
        .auth-logo h2 { color: white; font-weight: 900; font-size: 24px; margin: 0; }
        .auth-logo p { color: rgba(255,255,255,0.5); font-size: 14px; margin-top: 6px; }
        .otp-inputs { display: flex; gap: 10px; justify-content: center; margin: 24px 0; }
        .otp-input { width: 52px; height: 60px; border: 2px solid rgba(255,255,255,0.15); border-radius: 14px; text-align: center; font-size: 24px; font-weight: 800; font-family: inherit; background: rgba(255,255,255,0.06); color: white; outline: none; transition: all 0.3s ease; }
        .otp-input:focus { border-color: #8b5cf6; background: rgba(255,255,255,0.1); box-shadow: 0 0 0 4px rgba(139,92,246,0.15); }
        .otp-input::placeholder { color: rgba(255,255,255,0.15); }
        .btn-submit { width: 100%; height: 52px; border: none; border-radius: 12px; background: linear-gradient(135deg, #8b5cf6, #a78bfa); color: white; font-weight: 700; font-size: 15px; font-family: inherit; cursor: pointer; transition: all 0.3s ease; margin-top: 6px; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(139,92,246,0.4); }
        .auth-footer { text-align: center; margin-top: 24px; }
        .auth-footer a { color: #8b5cf6; font-weight: 700; text-decoration: none; font-size: 13px; }
        .auth-footer a:hover { color: #a78bfa; }
        .back-home { display: flex; align-items: center; justify-content: center; gap: 6px; color: rgba(255,255,255,0.4); font-size: 13px; text-decoration: none; transition: all 0.3s ease; }
        .back-home:hover { color: white; }
        .alert { border-radius: 12px; font-size: 13px; padding: 12px 16px; margin-bottom: 20px; }
        .alert-danger { background: rgba(239,68,68,0.15); border: 1px solid rgba(239,68,68,0.3); color: #fca5a5; }
        .alert-danger ul { margin-bottom: 0; padding-left: 18px; }
        .alert-success { background: rgba(16,185,129,0.15); border: 1px solid rgba(16,185,129,0.3); color: #6ee7b7; }
        .info-text { color: rgba(255,255,255,0.4); font-size: 13px; text-align: center; margin-bottom: 8px; line-height: 1.6; }
        .email-highlight { color: #8b5cf6; font-weight: 700; }
        .resend-link { color: rgba(255,255,255,0.4); font-size: 12px; text-align: center; margin-top: 16px; }
        .resend-link a { color: #8b5cf6; text-decoration: underline; }
        .resend-link form { display: inline; }
        .resend-btn { background: none; border: none; color: #8b5cf6; text-decoration: underline; cursor: pointer; font-size: 12px; font-family: inherit; padding: 0; }
        .resend-btn:hover { color: #a78bfa; }

        .step-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 24px;
        }

        .step {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 800;
        }

        .step-done {
            background: rgba(139,92,246,0.3);
            color: #a78bfa;
            border: 2px solid rgba(139,92,246,0.5);
        }

        .step-active {
            background: linear-gradient(135deg, #8b5cf6, #a78bfa);
            color: white;
            border: 2px solid #8b5cf6;
            box-shadow: 0 0 12px rgba(139,92,246,0.4);
        }

        .step-line {
            width: 40px;
            height: 2px;
            background: rgba(255,255,255,0.1);
        }

        .step-line-done {
            background: rgba(139,92,246,0.4);
        }
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
                <i data-lucide="shield-check" size="28"></i>
            </div>
            <h2>XÁC THỰC EMAIL</h2>
            <p>Nhập mã 6 số đã gửi về Gmail của bạn</p>
        </div>

        <!-- Step indicator -->
        <div class="step-indicator">
            <div class="step step-done">
                <i data-lucide="check" size="14"></i>
            </div>
            <div class="step-line step-line-done"></div>
            <div class="step step-active">2</div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <p class="info-text">
            Mã đã được gửi đến <span class="email-highlight">{{ session('register_email') }}</span>
        </p>

        <form method="POST" action="{{ route('register.verify.otp') }}" id="otpForm">
            @csrf
            <input type="hidden" name="otp" id="otpHidden">

            <div class="otp-inputs">
                <input type="text" class="otp-input" maxlength="1" data-index="0" autofocus inputmode="numeric">
                <input type="text" class="otp-input" maxlength="1" data-index="1" inputmode="numeric">
                <input type="text" class="otp-input" maxlength="1" data-index="2" inputmode="numeric">
                <input type="text" class="otp-input" maxlength="1" data-index="3" inputmode="numeric">
                <input type="text" class="otp-input" maxlength="1" data-index="4" inputmode="numeric">
                <input type="text" class="otp-input" maxlength="1" data-index="5" inputmode="numeric">
            </div>

            <button class="btn-submit" type="submit">
                <i data-lucide="check-circle" size="18"></i>
                XÁC THỰC & TẠO TÀI KHOẢN
            </button>
        </form>

        <p class="resend-link">
            Không nhận được mã? 
            <form method="POST" action="{{ route('register.resend.otp') }}">
                @csrf
                <button type="submit" class="resend-btn">Gửi lại</button>
            </form>
        </p>

        <div class="auth-footer">
            <a href="{{ route('register') }}" class="back-home mt-3">
                <i data-lucide="arrow-left" size="14"></i> Quay về đăng ký
            </a>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();

    // OTP input auto-focus & combine
    const inputs = document.querySelectorAll('.otp-input');
    const otpHidden = document.getElementById('otpHidden');
    const otpForm = document.getElementById('otpForm');

    inputs.forEach((input, index) => {
        input.addEventListener('input', (e) => {
            const val = e.target.value;
            if (val && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
            // Combine all values
            let otp = '';
            inputs.forEach(i => otp += i.value);
            otpHidden.value = otp;

            // Auto submit when all filled
            if (otp.length === 6) {
                otpForm.submit();
            }
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !input.value && index > 0) {
                inputs[index - 1].focus();
            }
        });

        // Handle paste
        input.addEventListener('paste', (e) => {
            e.preventDefault();
            const pasted = e.clipboardData.getData('text').replace(/\D/g, '').slice(0, 6);
            pasted.split('').forEach((char, i) => {
                if (inputs[i]) inputs[i].value = char;
            });
            otpHidden.value = pasted;
            if (pasted.length === 6) otpForm.submit();
        });
    });
</script>
</body>
</html>
