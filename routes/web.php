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
Route::get('/dashboard/setting', [ViewPageController::class, 'dashboardSetting'])->name('dashboard.setting');
Route::get('/dashboard/setting/list-banner-besar', [ViewPageController::class, 'dashboardSettingbannerbesar'])->name('dashboard.setting.bannerbesar');
Route::get('/dashboard/setting/list-banner-kecil', [ViewPageController::class, 'dashboardSettingbannerkecil'])->name('dashboard.setting.bannerkecil');
Route::get('/dashboard/setting/list-banner-kecil-2', [ViewPageController::class, 'dashboardSettingbannerkecil2'])->name('dashboard.setting.bannerkecil2');
Route::get('/dashboard/setting/list-rekening', [ViewPageController::class, 'dashboardSettingrekening'])->name('dashboard.setting.rekening');
Route::get('/dashboard/setting/list-wa', [ViewPageController::class, 'dashboardSettingwa'])->name('dashboard.setting.wa');
Route::get('/dashboard/setting/list-specialproduct', [ViewPageController::class, 'dashboardSettingspecialproduct'])->name('dashboard.setting.specialproduct');
// Halaman utama (shop page)
Route::get('/', function () {
    return view('shop-page');
});

// Rute untuk halaman peta, toko, dan produk
Route::get('/welcome-page',[ViewPageController::class, 'welcomepage']);
Route::get('/view-maps', [ViewPageController::class, 'maps']);
Route::get('/view-shop', [ViewPageController::class, 'shop']);
Route::get('/view-product', [ViewPageController::class, 'product'])->name('view.product.details');
Route::get('/view-productid', [ViewPageController::class, 'productbyid']);
