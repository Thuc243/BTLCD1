<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\PasswordResetOtp;

class ForgotPasswordController extends Controller
{
    /**
     * Hiện form nhập email
     */
    public function showForgotForm()
    {
        return view('auth.forgot_password');
    }

    /**
     * Gửi mã OTP về email
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Email này chưa được đăng ký trong hệ thống.',
        ]);

        // Xóa OTP cũ của email này
        PasswordResetOtp::where('email', $request->email)->delete();

        // Tạo OTP 6 số
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Lưu vào DB (hết hạn sau 10 phút)
        PasswordResetOtp::create([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => now()->addMinutes(10),
        ]);

        // Gửi email
        $emailSent = false;
        $mailError = '';
        try {
            Mail::send([], [], function ($message) use ($request, $otp) {
                $message->to($request->email)
                        ->subject('Phone Shop - Mã xác thực đặt lại mật khẩu')
                        ->html("
                            <div style='font-family: Arial, sans-serif; max-width: 500px; margin: 0 auto; padding: 30px; background: #f8fafc; border-radius: 12px;'>
                                <div style='text-align: center; margin-bottom: 24px;'>
                                    <h2 style='color: #1a1a2e; margin: 0;'>📱 PHONE SHOP</h2>
                                    <p style='color: #6b7280; font-size: 14px;'>Đặt lại mật khẩu</p>
                                </div>
                                <div style='background: white; padding: 24px; border-radius: 10px; text-align: center;'>
                                    <p style='color: #374151; font-size: 14px; margin-bottom: 20px;'>Mã xác thực của bạn là:</p>
                                    <div style='font-size: 36px; font-weight: 900; letter-spacing: 8px; color: #e94560; background: #fff5f5; padding: 16px; border-radius: 10px; display: inline-block;'>
                                        {$otp}
                                    </div>
                                    <p style='color: #9ca3af; font-size: 12px; margin-top: 20px;'>Mã có hiệu lực trong 10 phút. Không chia sẻ mã này với bất kỳ ai.</p>
                                </div>
                            </div>
                        ");
            });
            $emailSent = true;
        } catch (\Exception $e) {
            $emailSent = false;
            $mailError = $e->getMessage();
            Log::error('Forgot password OTP mail failed: ' . $e->getMessage());
        }

        // Lưu email vào session để dùng ở bước sau
        session(['reset_email' => $request->email]);

        if ($emailSent) {
            return redirect()->route('password.otp.form')->with('success', 'Đã gửi mã OTP về email ' . $request->email);
        } else {
            return redirect()->route('password.otp.form')->with('success', 'Mã OTP của bạn là: ' . $otp . ' (Lỗi: ' . $mailError . ')');
        }
    }

    /**
     * Hiện form nhập OTP
     */
    public function showOtpForm()
    {
        if (!session('reset_email')) {
            return redirect()->route('password.forgot');
        }
        return view('auth.verify_otp');
    }

    /**
     * Xác thực OTP
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        $email = session('reset_email');
        if (!$email) {
            return redirect()->route('password.forgot');
        }

        $record = PasswordResetOtp::where('email', $email)
                    ->where('otp', $request->otp)
                    ->where('expires_at', '>', now())
                    ->first();

        if (!$record) {
            return back()->withErrors(['otp' => 'Mã OTP không hợp lệ hoặc đã hết hạn.']);
        }

        // Đánh dấu đã xác thực OTP
        session(['otp_verified' => true]);

        return redirect()->route('password.reset.form');
    }

    /**
     * Hiện form đổi mật khẩu mới
     */
    public function showResetForm()
    {
        if (!session('reset_email') || !session('otp_verified')) {
            return redirect()->route('password.forgot');
        }
        return view('auth.reset_password');
    }

    /**
     * Đổi mật khẩu
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ], [
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
        ]);

        $email = session('reset_email');
        if (!$email || !session('otp_verified')) {
            return redirect()->route('password.forgot');
        }

        // Cập nhật mật khẩu
        $user = User::where('email', $email)->first();
        if ($user) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        // Xóa OTP và session
        PasswordResetOtp::where('email', $email)->delete();
        session()->forget(['reset_email', 'otp_verified']);

        return redirect()->route('login')->with('success', 'Đổi mật khẩu thành công! Bạn có thể đăng nhập ngay.');
    }
}
