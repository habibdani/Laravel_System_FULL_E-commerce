<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Rute untuk menampilkan form login
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');

// Rute untuk menangani proses login
Route::post('login', [AuthController::class, 'login']);

Route::get('/', function () {
    return view('welcome-page');
});

// Route::get('/maps', function () {
//     return view('maps-page');
// });

Route::post('/shop', function () {
    return view('shop-page');
});

use App\Http\Controllers\ViewPageController;

Route::post('/view-maps', [ViewPageController::class, 'maps']);
Route::post('/view-shop', [ViewPageController::class, 'shop']);

