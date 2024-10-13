<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViewPageController;

// Rute untuk menampilkan form login

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Route untuk ke dhasboard admin
Route::get('/dashboard', [ViewPageController::class, 'dashboard'])->name('dashboard');
Route::get('/dashboard/product', [ViewPageController::class, 'dashboardProduct'])->name('dashboard.product');
Route::get('/dashboard/product/add', [ViewPageController::class, 'dashboardProductAdd'])->name('dashboard.product.add');
Route::get('/dashboard/product/edit/{product_variant_id}', [ViewPageController::class, 'dashboardProductEdit'])->name('dashboard.product.edit');
Route::get('/dashboard/orders', [ViewPageController::class, 'dashboardOrders'])->name('dashboard.orders');
Route::get('/dashboard/orders/detail/{booking_id}', [ViewPageController::class, 'dashboardOrdersDetail'])->name('dashboard.orders.detail');

// Halaman utama (shop page)
Route::get('/', function () {
    return view('shop-page');
});

// Rute untuk halaman peta, toko, dan produk
Route::get('/view-maps', [ViewPageController::class, 'maps']);
Route::get('/view-shop', [ViewPageController::class, 'shop']);
Route::get('/view-product', [ViewPageController::class, 'product'])->name('view.product.details');
