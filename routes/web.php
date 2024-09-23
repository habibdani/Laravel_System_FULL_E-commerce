<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViewPageController;

// Rute untuk menampilkan form login
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');

// Rute untuk menangani proses login
Route::post('login', [AuthController::class, 'login']);

Route::get('/', function () {
    return view('shop-page');
});

Route::get('/view-maps', [ViewPageController::class, 'maps']);
Route::get('/view-shop', [ViewPageController::class, 'shop']);
Route::get('/view-product', [ViewPageController::class, 'product'])->name('view.product.details');
