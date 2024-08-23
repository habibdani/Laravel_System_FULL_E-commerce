<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Rute untuk menampilkan form login
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');

// Rute untuk menangani proses login
Route::post('login', [AuthController::class, 'login']);

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});
