<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminController;

/* AUTH */
Route::middleware('guest')->group(function(){
    Route::get('/login', function(){
        return view('auth.login');
    })->name('login');
    
    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
    
    Route::get('/register', function(){
        return view('auth.register');
    })->name('register');
    
    Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register']);
});

Route::post('/logout', [\App\Http\Controllers\Auth\LogoutController::class, 'logout'])->middleware('auth')->name('logout');

/* USER */
Route::get('/', [ShopController::class,'home']);

Route::middleware('auth')->group(function(){
    Route::get('/cart', [ShopController::class,'cart']);
    Route::get('/add/{id}', [ShopController::class,'add']);
    Route::get('/remove/{id}', [ShopController::class,'remove']);
    Route::get('/checkout', [ShopController::class,'checkout']);
    Route::post('/order', [ShopController::class,'order']);
    Route::get('/orders', [ShopController::class,'orders']);
});

/* ADMIN */
Route::prefix('admin')->middleware('auth')->group(function(){

    Route::get('/', [AdminController::class,'dashboard']);

    Route::get('/phones', [AdminController::class,'phones']);
    Route::get('/phones/create',[AdminController::class,'create']);   // ✅ sửa
    Route::post('/phones/store',[AdminController::class,'store']);    // ✅ sửa
    Route::get('/phones/delete/{id}',[AdminController::class,'delete']); // ✅ sửa

    Route::get('/orders', [AdminController::class,'orders']);
    Route::get('/users', [AdminController::class,'users']);
});