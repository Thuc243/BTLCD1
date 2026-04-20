<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PasswordResetOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /**
     * Bước 1: Gửi OTP qua AJAX
     */
    public function sendOtpAjax(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'email',
                    'unique:users',
                    'regex:/^[a-zA-Z0-9._%+\-]+@gmail\.com$/i',
                ],
                'password' => 'required|min:6|confirmed'
            ], [
                'email.regex' => 'Chỉ chấp nhận tài khoản Google (Gmail).',
                'email.unique' => 'Email này đã được đăng ký.',
                'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            ]);

            // Save basic data into session for the next step just in case, but frontend passes it anyway
            session([
                'register_email' => $request->email
            ]);
            
            // Xóa OTP cũ nếu có
            PasswordResetOtp::where('email', $request->email)->delete();

            // Tạo OTP 6 số
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            // Lưu OTP vào DB (hết hạn sau 10 phút)
            PasswordResetOtp::create([
                'email' => $request->email,
                'otp' => $otp,
                'expires_at' => now()->addMinutes(10),
            ]);

            // Gửi email OTP
            Mail::send([], [], function ($message) use ($request, $otp) {
                $message->to($request->email)
                        ->subject('Phone Shop - Mã xác thực đăng ký tài khoản')
                        ->html("
                            <div style='font-family: Arial, sans-serif; max-width: 500px; margin: 0 auto; padding: 30px; background: #f8fafc; border-radius: 12px;'>
                                <div style='text-align: center; margin-bottom: 24px;'>
                                    <h2 style='color: #1a1a2e; margin: 0;'>📱 PHONE SHOP</h2>
                                    <p style='color: #6b7280; font-size: 14px;'>Xác thực đăng ký tài khoản</p>
                                </div>
                                <div style='background: white; padding: 24px; border-radius: 10px; text-align: center;'>
                                    <p style='color: #374151; font-size: 14px; margin-bottom: 8px;'>Xin chào <strong>{$request->name}</strong>,</p>
                                    <p style='color: #374151; font-size: 14px; margin-bottom: 20px;'>Mã xác thực đăng ký của bạn là:</p>
                                    <div style='font-size: 36px; font-weight: 900; letter-spacing: 8px; color: #8b5cf6; background: #f5f3ff; padding: 16px; border-radius: 10px; display: inline-block;'>
                                        {$otp}
                                    </div>
                                    <p style='color: #9ca3af; font-size: 12px; margin-top: 20px;'>Mã có hiệu lực trong 10 phút. Không chia sẻ mã này với bất kỳ ai.</p>
                                </div>
                            </div>
                        ");
            });

            return response()->json(['success' => true, 'message' => 'Mã OTP đã được gửi về email của bạn.']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'message' => 'Dữ liệu không hợp lệ.', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Register OTP mail failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Lỗi hệ thống khi gửi email: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Bước 2: Nhận form submit (đã có OTP), xác thực và lưu DB
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'unique:users',
                'regex:/^[a-zA-Z0-9._%+\-]+@gmail\.com$/i',
            ],
            'password' => 'required|min:6|confirmed',
            'otp' => 'required|string|size:6',
        ], [
            'email.regex' => 'Chỉ chấp nhận tài khoản Google (Gmail).',
            'email.unique' => 'Email này đã được đăng ký.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'otp.required' => 'Mã OTP là bắt buộc.',
            'otp.size' => 'Mã OTP phải có 6 chữ số.'
        ]);

        $email = $request->email;

        // Kiểm tra OTP
        $record = PasswordResetOtp::where('email', $email)
                    ->where('otp', $request->otp)
                    ->where('expires_at', '>', now())
                    ->first();

        if (!$record) {
            return back()->withInput()->withErrors(['otp' => 'Mã OTP không hợp lệ hoặc đã hết hạn.']);
        }

        // Xác định role: admin cho maianhthuc2206@gmail.com
        $role = 'user';
        if (strtolower($email) === 'maianhthuc2206@gmail.com') {
            $role = 'admin';
        }

        // Tạo user
        $user = User::create([
            'name' => $request->name,
            'email' => $email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        // Xóa OTP
        PasswordResetOtp::where('email', $email)->delete();
        session()->forget(['register_email']);

        // Đăng nhập
        Auth::login($user);

        return redirect('/')->with('success', 'Đăng ký thành công! Chào mừng bạn đến với Phone Shop.');
    }


}
