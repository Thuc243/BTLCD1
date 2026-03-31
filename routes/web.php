<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;

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
});

Route::post('/logout', [LogoutController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| USER (FRONTEND)
|--------------------------------------------------------------------------
*/

// Trang chủ + tìm kiếm + lọc hãng
Route::get('/', [ShopController::class, 'home']);

// Lọc theo hãng
Route::get('/category/{id}', [ShopController::class, 'category']);

Route::middleware('auth')->group(function () {

    // 🛒 Giỏ hàng
    Route::get('/cart', [ShopController::class, 'cart']);
    Route::get('/add/{id}', [ShopController::class, 'add']);
    Route::post('/cart/update/{id}', [ShopController::class, 'updateCart']);
    Route::get('/remove/{id}', [ShopController::class, 'remove']);

    // 💳 Thanh toán
    Route::get('/checkout', [ShopController::class, 'checkout']);
    Route::post('/order', [ShopController::class, 'order']);

    // 📦 Đơn hàng
    Route::get('/orders', [ShopController::class, 'orders']);
});


/*
|--------------------------------------------------------------------------
| ADMIN (BACKEND)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('auth')->group(function () {

    // 📊 Dashboard
    Route::get('/', [AdminController::class, 'dashboard']);

    // 📱 Quản lý sản phẩm
    Route::get('/phones', [AdminController::class, 'phones']);
    Route::get('/phones/create', [AdminController::class, 'create']);
    Route::post('/phones/store', [AdminController::class, 'store']);
    Route::get('/phones/delete/{id}', [AdminController::class, 'delete']);

    // 📦 Đơn hàng
    Route::get('/orders', [AdminController::class, 'orders']);

    // 👥 Người dùng
    Route::get('/users', [AdminController::class, 'users']);
});