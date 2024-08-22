<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/shippings', [ShippingController::class, 'getShippings']);
Route::get('/shipping-districts', [ShippingController::class, 'getShippingDistricts']);

Route::get('/list-products', [ProductController::class, 'listproduct']);
Route::get('/product/details', [ProductController::class, 'productdetails']);

Route::get('/list-product-type',[ProductController::class, 'getListProductType']);
Route::get('/list-variant-type', [ProductController::class, 'getListVariantType']);

Route::post('/upload-image', [ProductController::class, 'uploadImage'])->middleware('auth.admin');
Route::post('/insert-product', [ProductController::class, 'insertProduct'])->middleware('auth.admin');
Route::post('/insert-product-type', [ProductController::class, 'createProductType'])->middleware('auth.admin');
Route::post('/insert-variant-type', [ProductController::class, 'createVariantType'])->middleware('auth.admin');

Route::put('/update-product/{id}', [ProductController::class, 'updateProduct'])->middleware('auth.admin');
Route::delete('/deleted-product/{id}', [ProductController::class, 'deleteProduct'])->middleware('auth.admin');

Route::post('/admin/register', [AuthController::class, 'register']);
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/list-order', [BookingController::class, 'getListOrder']);
Route::get('/detail-order',[BookingController::class, 'getDetilsOrder']);
Route::post('/update-status-order',[BookingController::class, 'updateStatusOrder'])->middleware('auth.admin');
Route::post('/create-orders', [BookingController::class, 'createOrder'])->middleware('auth.admin');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    // Tambahkan route lainnya yang ingin diproteksi di sini
});
