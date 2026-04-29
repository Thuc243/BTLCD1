<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            
            $role = Auth::user()->role;
            if ($role === 'shipper') {
                return redirect('/shipper/orders');
            } elseif ($role === 'admin') {
                return redirect('/admin');
            }
            
            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Đăng nhập không thành công'
        ])->onlyInput('email');
    }
}
