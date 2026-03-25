<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhoneController;

Route::get('/', function () {
    return view('home');
});

Route::get('/phones',[PhoneController::class,'index']);

Route::get('/phones/create',[PhoneController::class,'create']);

Route::post('/phones/store',[PhoneController::class,'store']);

Route::get('/phones/edit/{id}',[PhoneController::class,'edit']);