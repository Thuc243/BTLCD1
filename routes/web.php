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

// 🏠 Trang chủ + tìm kiếm
Route::get('/', [ShopController::class, 'home'])->name('home');

// 📱 Lọc theo hãng
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

    // 📦 ĐƠN HÀNG
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/orders/status/{id}/{status}', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.status');
    Route::get('/orders/delete/{id}', [AdminController::class, 'deleteOrder'])->name('admin.orders.delete');

    // 👥 NGƯỜI DÙNG
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
});