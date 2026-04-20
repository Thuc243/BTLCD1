<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\GoogleController;

// 🧪 TEST MAIL - Xóa route này sau khi test xong
Route::get('/test-mail', function () {
    try {
        Mail::send([], [], function ($message) {
            $message->to('thuc1234vvp@gmail.com')
                    ->subject('Test Mail từ Phone Shop')
                    ->html('<h1>Mail gửi thành công!</h1><p>Hệ thống email hoạt động bình thường.</p>');
        });
        return '<h1 style="color:green">✅ Gửi mail thành công!</h1><p>Kiểm tra hộp thư của bạn.</p>';
    } catch (\Exception $e) {
        return '<h1 style="color:red">❌ Lỗi gửi mail</h1><pre>' . $e->getMessage() . '</pre><hr><pre>' . $e->getTraceAsString() . '</pre>';
    }
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', [RegisterController::class, 'register']);

    // 📧 XÁC THỰC OTP ĐĂNG KÝ (AJAX)
    Route::post('/register/send-otp', [RegisterController::class, 'sendOtpAjax'])->name('register.send.otp');
    Route::post('/register/verify-otp', [RegisterController::class, 'verifyOtp'])->name('register.verify.otp');
    Route::post('/register/resend-otp', [RegisterController::class, 'resendOtp'])->name('register.resend.otp');

    // 🔑 QUÊN MẬT KHẨU
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.forgot');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendOtp'])->name('password.send.otp');
    Route::get('/verify-otp', [ForgotPasswordController::class, 'showOtpForm'])->name('password.otp.form');
    Route::post('/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('password.verify.otp');
    Route::get('/reset-password', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset.form');
    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');
});

Route::post('/logout', [LogoutController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');




/*
|--------------------------------------------------------------------------
| USER (FRONTEND)
|--------------------------------------------------------------------------
*/

// 🏠 Trang chủ + tìm kiếm
Route::get('/', [ShopController::class, 'home'])->name('home');

// 📱 Chi tiết sản phẩm
Route::get('/product/{id}', [ShopController::class, 'detail'])->name('product.detail');

// 📂 Lọc theo hãng
Route::get('/category/{id}', [ShopController::class, 'category'])->name('category');


Route::middleware('auth')->group(function () {

    // 🛒 GIỎ HÀNG
    Route::get('/cart', [ShopController::class, 'cart'])->name('cart');
    Route::get('/add/{id}', [ShopController::class, 'add'])->name('add');
    Route::post('/cart/update/{id}', [ShopController::class, 'updateCart'])->name('cart.update');
    Route::get('/remove/{id}', [ShopController::class, 'remove'])->name('remove');

    // 💳 THANH TOÁN
    Route::get('/checkout', [ShopController::class, 'checkout'])->name('checkout');
    Route::post('/order', [ShopController::class, 'order'])->name('order');

    // 📦 ĐƠN HÀNG
    Route::get('/orders', [ShopController::class, 'orders'])->name('orders');

    // ⭐ ĐÁNH GIÁ & BÌNH LUẬN
    Route::post('/product/{id}/review', [ShopController::class, 'storeReview'])->name('review.store');
    Route::post('/review/{id}/reply', [ShopController::class, 'replyReview'])->name('review.reply');
    Route::delete('/review/{id}', [ShopController::class, 'deleteReview'])->name('review.delete');
});


/*
|--------------------------------------------------------------------------
| ADMIN (BACKEND)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    // 📊 DASHBOARD
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // 📱 SẢN PHẨM
    Route::get('/phones', [AdminController::class, 'phones'])->name('admin.phones');

    Route::get('/phones/create', [AdminController::class, 'create'])->name('admin.phones.create');
    Route::post('/phones/store', [AdminController::class, 'store'])->name('admin.phones.store');

    Route::get('/phones/edit/{id}', [AdminController::class, 'edit'])->name('admin.phones.edit');
    Route::post('/phones/update/{id}', [AdminController::class, 'update'])->name('admin.phones.update');

    Route::get('/phones/delete/{id}', [AdminController::class, 'delete'])->name('admin.phones.delete');

    // 📁 DANH MỤC
    Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::post('/categories/store', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::post('/categories/update/{id}', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
    Route::get('/categories/delete/{id}', [AdminController::class, 'deleteCategory'])->name('admin.categories.delete');

    // 📦 ĐƠN HÀNG
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/orders/status/{id}/{status}', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.status');
    Route::get('/orders/delete/{id}', [AdminController::class, 'deleteOrder'])->name('admin.orders.delete');

    // 👥 NGƯỜI DÙNG
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
});