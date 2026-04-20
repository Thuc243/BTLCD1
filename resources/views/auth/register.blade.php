<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Đăng ký | Phone Shop</title>
    
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
            overflow-x: hidden;
            overflow-y: auto;
            padding: 20px;
        }

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

        .bg-orb-1 { width: 400px; height: 400px; background: #8b5cf6; top: -100px; right: -100px; }
        .bg-orb-2 { width: 300px; height: 300px; background: #e94560; bottom: -80px; left: -80px; animation-delay: -4s; }
        .bg-orb-3 { width: 200px; height: 200px; background: #f59e0b; top: 60%; left: 30%; animation-delay: -2s; }

        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-30px) scale(1.05); }
        }

        .auth-container {
            width: 100%;
            max-width: 480px;
            position: relative;
            z-index: 1;
        }

        .auth-card {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            padding: 24px 28px;
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.1);
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 16px;
        }

        .auth-logo-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: linear-gradient(135deg, #8b5cf6, #a78bfa);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            color: white;
        }

        .auth-logo h2 { color: white; font-weight: 900; font-size: 24px; margin: 0; }
        .auth-logo p { color: rgba(255,255,255,0.5); font-size: 14px; margin-top: 6px; }

        .form-group { margin-bottom: 12px; }

        .form-label {
            display: block;
            color: rgba(255,255,255,0.7);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .input-wrapper { position: relative; }

        .input-wrapper input {
            width: 100%;
            height: 42px;
            border: 2px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 0 14px 0 40px;
            font-size: 14px;
            font-family: inherit;
            background: rgba(255,255,255,0.06);
            color: white;
            transition: all 0.3s ease;
            outline: none;
        }

        .input-wrapper input::placeholder { color: rgba(255,255,255,0.3); }

        .input-wrapper input:focus {
            border-color: #8b5cf6;
            background: rgba(255,255,255,0.1);
            box-shadow: 0 0 0 4px rgba(139,92,246,0.15);
        }

        .input-wrapper .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.3);
        }

        /* Buttons */
        .btn-send-otp {
            width: 100%;
            height: 42px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #8b5cf6, #a78bfa);
            color: white;
            font-weight: 700;
            font-size: 14px;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 8px;
        }

        .btn-send-otp:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(139,92,246,0.4);
        }

        .btn-send-otp:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .btn-register {
            width: 100%;
            height: 42px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #10b981, #34d399);
            color: white;
            font-weight: 700;
            font-size: 14px;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 12px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(16,185,129,0.4);
        }

        .otp-section {
            display: block;
            margin-top: 12px;
            padding: 12px 16px;
            background: rgba(139,92,246,0.08);
            border: 1px solid rgba(139,92,246,0.2);
            border-radius: 12px;
            animation: slideDown 0.4s ease;
        }

        .otp-section.show {
            display: block;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .otp-section .otp-title {
            color: #a78bfa;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .otp-input-group {
            display: flex;
            gap: 8px;
        }

        .otp-input-group input {
            flex: 1;
            height: 42px;
            border: 2px solid rgba(139,92,246,0.3);
            border-radius: 10px;
            padding: 0 16px;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 6px;
            text-align: center;
            font-family: inherit;
            background: rgba(255,255,255,0.06);
            color: #a78bfa;
            outline: none;
            transition: all 0.3s ease;
        }

        .otp-input-group input:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 4px rgba(139,92,246,0.15);
        }

        .otp-input-group input::placeholder {
            color: rgba(255,255,255,0.2);
            font-size: 14px;
            letter-spacing: 0;
            font-weight: 400;
        }

        .resend-link {
            color: rgba(255,255,255,0.4);
            font-size: 12px;
            margin-top: 8px;
            text-align: right;
        }

        .resend-link a {
            color: #a78bfa;
            cursor: pointer;
            text-decoration: none;
            font-weight: 600;
        }

        .resend-link a:hover { color: #8b5cf6; }
        .resend-link a.disabled { opacity: 0.4; pointer-events: none; }

        .auth-footer { text-align: center; margin-top: 16px; }

        .auth-footer p {
            color: rgba(255,255,255,0.5);
            font-size: 13px;
        }

        .auth-footer a {
            color: #8b5cf6;
            font-weight: 700;
            text-decoration: none;
        }

        .auth-footer a:hover { color: #a78bfa; }

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
            border-radius: 10px;
            font-size: 12px;
            padding: 10px 14px;
            margin-bottom: 16px;
        }

        .alert-error {
            background: rgba(239,68,68,0.15);
            border: 1px solid rgba(239,68,68,0.3);
            color: #fca5a5;
        }

        .alert-success {
            background: rgba(16,185,129,0.15);
            border: 1px solid rgba(16,185,129,0.3);
            color: #6ee7b7;
        }

        .alert ul { margin-bottom: 0; padding-left: 18px; }

        .email-hint {
            color: rgba(255,255,255,0.35);
            font-size: 11px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .email-hint i { color: #f59e0b; }

        .info-steps {
            background: rgba(139,92,246,0.08);
            border: 1px solid rgba(139,92,246,0.15);
            border-radius: 10px;
            padding: 10px 12px;
            margin-bottom: 16px;
        }

        .info-steps p {
            color: rgba(255,255,255,0.45);
            font-size: 11px;
            margin: 0;
            line-height: 1.5;
        }

        .info-steps .step-label {
            color: #a78bfa;
            font-weight: 700;
        }

        #statusMsg {
            border-radius: 10px;
            font-size: 12px;
            padding: 8px 12px;
            margin-top: 10px;
            display: none;
        }

        #statusMsg.show { display: block; }

        .spinner-icon {
            animation: spin 1s linear infinite;
            display: inline-block;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
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
                <i data-lucide="user-plus" size="28"></i>
            </div>
            <h2>PHONE SHOP</h2>
            <p>Tạo tài khoản mới</p>
        </div>

        <div class="info-steps">
            <p><span class="step-label">Bước 1:</span> Nhập thông tin & nhấn "Gửi mã xác thực"</p>
            <p><span class="step-label">Bước 2:</span> Nhập mã OTP từ email & nhấn "Đăng ký"</p>
        </div>

        @if($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <div class="form-group">
                <label class="form-label">Họ và tên</label>
                <div class="input-wrapper">
                    <i data-lucide="user" size="18" class="input-icon"></i>
                    <input type="text" name="name" id="inputName" placeholder="Nguyễn Văn A" required value="{{ old('name') }}">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Email (Gmail)</label>
                <div class="input-wrapper">
                    <i data-lucide="mail" size="18" class="input-icon"></i>
                    <input type="email" name="email" id="inputEmail" placeholder="yourname@gmail.com" required value="{{ old('email') }}">
                </div>
                <div class="email-hint">
                    <i data-lucide="info" size="12"></i>
                    Chỉ chấp nhận tài khoản Google (Gmail)
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="form-label">Mật khẩu</label>
                        <div class="input-wrapper">
                            <i data-lucide="lock" size="18" class="input-icon"></i>
                            <input type="password" name="password" id="inputPassword" placeholder="••••••••" required>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="form-label">Xác nhận</label>
                        <div class="input-wrapper">
                            <i data-lucide="shield-check" size="18" class="input-icon"></i>
                            <input type="password" name="password_confirmation" id="inputPasswordConfirm" placeholder="••••••••" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nút GỬI MÃ XÁC THỰC - không submit form, gọi AJAX -->
            <button class="btn-send-otp" type="button" id="btnSendOtp" onclick="sendOtp()">
                <i data-lucide="send" size="16"></i>
                GỬI MÃ XÁC THỰC
            </button>

            <!-- Thông báo trạng thái -->
            <div id="statusMsg"></div>

            <!-- OTP Section -->
            <div class="otp-section" id="otpSection">
                <div class="otp-title">
                    <i data-lucide="shield" size="14"></i>
                    Nhập mã OTP đã gửi về email
                </div>
                <div class="otp-input-group">
                    <input type="text" name="otp" id="inputOtp" maxlength="6" placeholder="Nhập 6 số" autocomplete="off">
                </div>
                <div class="resend-link">
                    <a href="javascript:void(0)" onclick="sendOtp()" id="resendLink">Gửi lại mã</a>
                </div>
            </div>

            <!-- Nút ĐĂNG KÝ -->
            <button class="btn-register" type="submit" id="btnRegister">
                <i data-lucide="user-check" size="16"></i>
                ĐĂNG KÝ
            </button>
        </form>

        <div class="auth-footer">
            <p class="mt-3">Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></p>
            <a href="{{ route('home') }}" class="back-home mt-3">
                <i data-lucide="arrow-left" size="14"></i> Quay về trang chủ
            </a>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();

    let otpSent = false;
    let cooldown = 0;
    let cooldownTimer = null;

    function showStatus(msg, type) {
        const el = document.getElementById('statusMsg');
        el.className = 'show';
        if (type === 'success') {
            el.style.background = 'rgba(16,185,129,0.15)';
            el.style.border = '1px solid rgba(16,185,129,0.3)';
            el.style.color = '#6ee7b7';
        } else if (type === 'error') {
            el.style.background = 'rgba(239,68,68,0.15)';
            el.style.border = '1px solid rgba(239,68,68,0.3)';
            el.style.color = '#fca5a5';
        } else {
            el.style.background = 'rgba(139,92,246,0.15)';
            el.style.border = '1px solid rgba(139,92,246,0.3)';
            el.style.color = '#a78bfa';
        }
        el.innerHTML = msg;
    }

    function hideStatus() {
        document.getElementById('statusMsg').className = '';
    }

    function startCooldown(seconds) {
        cooldown = seconds;
        const btn = document.getElementById('btnSendOtp');
        const resend = document.getElementById('resendLink');

        btn.disabled = true;
        resend.classList.add('disabled');

        clearInterval(cooldownTimer);
        cooldownTimer = setInterval(() => {
            cooldown--;
            btn.innerHTML = '<i data-lucide="clock" size="16"></i> Gửi lại sau ' + cooldown + 's';
            resend.textContent = 'Gửi lại sau ' + cooldown + 's';

            if (cooldown <= 0) {
                clearInterval(cooldownTimer);
                btn.disabled = false;
                btn.innerHTML = '<i data-lucide="send" size="16"></i> GỬI LẠI MÃ';
                resend.textContent = 'Gửi lại mã';
                resend.classList.remove('disabled');
                lucide.createIcons();
            }
        }, 1000);
    }

    async function sendOtp() {
        const name = document.getElementById('inputName').value.trim();
        const email = document.getElementById('inputEmail').value.trim();
        const password = document.getElementById('inputPassword').value;
        const passwordConfirm = document.getElementById('inputPasswordConfirm').value;

        // Validate phía client
        if (!name) { showStatus('⚠️ Vui lòng nhập họ và tên.', 'error'); return; }
        if (!email) { showStatus('⚠️ Vui lòng nhập email.', 'error'); return; }
        if (!email.match(/^[a-zA-Z0-9._%+\-]+@gmail\.com$/i)) {
            showStatus('⚠️ Chỉ chấp nhận email Gmail (@gmail.com).', 'error'); return;
        }
        if (!password || password.length < 6) {
            showStatus('⚠️ Mật khẩu phải có ít nhất 6 ký tự.', 'error'); return;
        }
        if (password !== passwordConfirm) {
            showStatus('⚠️ Mật khẩu xác nhận không khớp.', 'error'); return;
        }

        if (cooldown > 0) return;

        // Hiển thị loading
        const btn = document.getElementById('btnSendOtp');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-icon">⏳</span> Đang gửi mã...';
        showStatus('⏳ Đang gửi mã xác thực về ' + email + '... Vui lòng đợi.', 'info');

        try {
            const response = await fetch('{{ route("register.send.otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ name, email, password, password_confirmation: passwordConfirm })
            });

            const data = await response.json();

            if (data.success) {
                otpSent = true;
                showStatus('✅ ' + data.message, 'success');

                // Hiện ô OTP và nút Đăng ký
                document.getElementById('otpSection').classList.add('show');
                document.getElementById('btnRegister').style.display = 'flex';
                document.getElementById('inputOtp').focus();

                // Cooldown 60 giây
                startCooldown(60);
                lucide.createIcons();
            } else {
                let errorMsg = data.message || 'Có lỗi xảy ra.';
                if (data.errors) {
                    errorMsg = Object.values(data.errors).flat().join('<br>');
                }
                showStatus('❌ ' + errorMsg, 'error');
                btn.disabled = false;
                btn.innerHTML = '<i data-lucide="send" size="16"></i> GỬI MÃ XÁC THỰC';
                lucide.createIcons();
            }
        } catch (err) {
            showStatus('❌ Lỗi kết nối. Vui lòng thử lại.', 'error');
            btn.disabled = false;
            btn.innerHTML = '<i data-lucide="send" size="16"></i> GỬI MÃ XÁC THỰC';
            lucide.createIcons();
        }
    }

    // Validate form khi nhấn Đăng ký
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        const otp = document.getElementById('inputOtp').value.trim();
        if (!otp || otp.length !== 6) {
            e.preventDefault();
            showStatus('⚠️ Vui lòng nhập đủ 6 số mã OTP.', 'error');
            document.getElementById('inputOtp').focus();
            return;
        }

        const btn = document.getElementById('btnRegister');
        btn.style.opacity = '0.7';
        btn.style.pointerEvents = 'none';
        btn.innerHTML = '<span class="spinner-icon">⏳</span> Đang xử lý...';
    });
</script>
</body>
</html>
