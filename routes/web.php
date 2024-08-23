<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;


// Rute untuk menampilkan form login
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');

// Rute untuk menangani proses login
Route::post('login', [AuthController::class, 'login']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');





// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
//     // Tambahkan route lainnya yang ingin diproteksi di sini
// });
