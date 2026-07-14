<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

// 新規登録
Route::get('/register', [RegisterController::class, 'show'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'store']);

// ログイン
Route::get('/login', [LoginController::class, 'show'])
    ->name('login');
Route::post('/login', [LoginController::class, 'login']);

// ログアウト
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');