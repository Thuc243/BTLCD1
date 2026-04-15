<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect tới Google OAuth
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Callback từ Google - Đăng nhập hoặc tạo tài khoản mới
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['error' => 'Đăng nhập Google thất bại. Vui lòng thử lại.']);
        }

        // Tìm user theo email
        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            // User đã tồn tại → đăng nhập
            // Cập nhật google_id nếu chưa có
            if (!$user->google_id) {
                $user->update(['google_id' => $googleUser->getId()]);
            }
            Auth::login($user);
        } else {
            // Tạo user mới từ Google
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'password' => Hash::make(Str::random(24)), // Random password
            ]);
            Auth::login($user);
        }

        return redirect('/');
    }
}
