<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;

Route::get('/shippings', [ShippingController::class, 'getShippings']);
Route::get('/shipping-districts', [ShippingController::class, 'getShippingDistricts']);

Route::get('/list-products', [ProductController::class, 'listproduct']);
Route::get('/product/details', [ProductController::class, 'productdetails']);

Route::get('/list-product-type',[ProductController::class, 'getListProductType']);
Route::get('/list-variant-type', [ProductController::class, 'getListVariantType']);
Route::get('/list-dropdown', [ProductController::class, 'getListDropdown']);

Route::post('/admin/register', [AuthController::class, 'register'])->middleware(\App\Http\Middleware\PasswordAuthMiddleware::class);;
Route::post('/admin/login', [AuthController::class, 'login']);

Route::post('/create-orders', [BookingController::class, 'createOrder']);

Route::middleware(\App\Http\Middleware\AdminAuthMiddleware::class)->group(function () {
    Route::post('/upload-image', [ProductController::class, 'uploadImage']);
    Route::post('/insert-product', [ProductController::class, 'insertProduct']);
    Route::post('/insert-product-type', [ProductController::class, 'createProductType']);
    Route::post('/insert-variant-type', [ProductController::class, 'createVariantType']);
    Route::put('/update-product/{id}', [ProductController::class, 'updateProduct']);
    Route::delete('/deleted-product/{id}', [ProductController::class, 'deleteProduct']);
    Route::post('/update-status-order', [BookingController::class, 'updateStatusOrder']);
    Route::get('/list-order', [BookingController::class, 'getListOrder']);
    Route::get('/detail-order',[BookingController::class, 'getDetilsOrder']);
    Route::post('/admin/logout', [AuthController::class, 'logout']);
    Route::get('/list-products-data', [ProductController::class, 'listproductData']);
    // Route::post('/create-order')
});

Route::get('/test-middleware', function() {
    return response()->json(['message' => 'Middleware is working']);
})->middleware(\App\Http\Middleware\AdminAuthMiddleware::class);

