<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Game\DashboardController;
use App\Http\Controllers\Game\ShopController;
use App\Http\Controllers\Game\BusinessController;
use App\Http\Controllers\Game\MenuController;
use App\Http\Controllers\Game\UpgradeController;
use App\Http\Controllers\Game\StaffController;

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

// game
Route::middleware('auth')->prefix('game')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/shops/create', [ShopController::class, 'create'])
        ->name('shops.create');
    
    Route::post('/shops', [ShopController::class, 'store'])
        ->name('shops.store');

    Route::post('/business', [BusinessController::class, 'store'])
        ->name('business.store');
    
    Route::get('/menus', [MenuController::class, 'index'])
        ->name('menus.index');
    
    Route::post('/menus/{menu}/develop', [MenuController::class, 'develop'])
        ->name('menus.develop');

    // 設備強化
    Route::post('/upgrade/kitchen', [UpgradeController::class, 'kitchen'])
        ->name('upgrade.kitchen');

    Route::post('/upgrade/table', [UpgradeController::class, 'table'])
        ->name('upgrade.table');

    Route::post('/upgrade/interior', [UpgradeController::class, 'interior'])
        ->name('upgrade.interior');

    // 従業員雇用
    Route::post('/staff/part-time', [StaffController::class, 'partTime'])
        ->name('staff.part_time');

    Route::post('/staff/veteran', [StaffController::class, 'veteran'])
        ->name('staff.veteran');

    Route::post('/staff/chef', [StaffController::class, 'chef'])
        ->name('staff.chef');
});