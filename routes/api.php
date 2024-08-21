<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/shippings', [ShippingController::class, 'getShippings']);
Route::get('/shipping-districts', [ShippingController::class, 'getShippingDistricts']);

Route::get('/list-products', [ProductController::class, 'listproduct']);
Route::get('/product/details', [ProductController::class, 'productdetails']);

Route::get('/list-product-type',[ProductController::class, 'getListProductType']);
Route::get('/list-variant-type', [ProductController::class, 'getListVariantType']);

Route::post('/upload-image', [ProductController::class, 'uploadImage']);
Route::post('/insert-product', [ProductController::class, 'insertProduct']);
Route::post('/insert-product-type', [ProductController::class, 'createProductType']);
Route::post('/insert-variant-type', [ProductController::class, 'createVariantType']);

Route::put('/update-product/{id}', [ProductController::class, 'updateProduct']);
Route::delete('/deleted-product/{id}', [ProductController::class, 'deleteProduct']);

Route::post('/admin/register', [AuthController::class, 'register']);
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    // Tambahkan route lainnya yang ingin diproteksi di sini
});
