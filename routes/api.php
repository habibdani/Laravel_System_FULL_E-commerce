<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EmailController;

Route::get('/shippings', [ShippingController::class, 'getShippings']);
Route::get('/shipping-districts', [ShippingController::class, 'getShippingDistricts']);
Route::post('/send-email', [EmailController::class, 'sendEmail']);

Route::get('/list-products', [ProductController::class, 'listproduct']);
Route::get('/product/details', [ProductController::class, 'productdetails']);

// Banner Besar Routes
Route::get('/banner-besar', [ProductController::class, 'getBannerBesar']); // Read All
Route::get('/banner-besar/{id}', [ProductController::class, 'getBannerBesarById']); // Read Single

// Banner Kecil Routes
Route::get('/banner-kecil', [ProductController::class, 'getBannerKecil']); // Read All
Route::get('/banner-kecil/{id}', [ProductController::class, 'getBannerKecilById']); // Read Single
Route::post('/banner-kecil', [ProductController::class, 'createBannerKecil']); // Create
Route::put('/banner-kecil/{id}', [ProductController::class, 'updateBannerKecil']); // Update
Route::delete('/banner-kecil/{id}', [ProductController::class, 'deleteBannerKecil']); // Delete

Route::get('/banner-kecil-2', [ProductController::class, 'getBannerKecil2']); // Read All
Route::put('/banner-kecil-2/{id}', [ProductController::class, 'updateBannerKecil2']); // Update

Route::get('/banner-best-product', [ProductController::class, 'getBannerBestProduct']); // Read All

Route::get('/info-rekening', [ProductController::class, 'getInfoRekening']); // Read All
Route::get('/info-rekening/{id}', [ProductController::class, 'getInfoRekeningById']); // Read Single
Route::post('/info-rekening', [ProductController::class, 'createInfoRekening']); // Create
Route::put('/info-rekening/{id}', [ProductController::class, 'updateInfoRekening']); // Update
Route::delete('/info-rekening/{id}', [ProductController::class, 'deleteInfoRekening']); // Delete

// RUD untuk info_wa
Route::get('/info-wa', [ProductController::class, 'getInfoWa']); // Read
Route::put('/info-wa', [ProductController::class, 'updateInfoWa']); // Update
Route::delete('/info-wa', [ProductController::class, 'deleteInfoWa']); // Delete

Route::get('/list-product-type',[ProductController::class, 'getListProductType']);
Route::get('/list-variant-type', [ProductController::class, 'getListVariantType']);
Route::get('/list-dropdown', [ProductController::class, 'getListDropdown']);

Route::post('/admin/register', [AuthController::class, 'register'])->middleware(\App\Http\Middleware\PasswordAuthMiddleware::class);
Route::post('/admin/login', [AuthController::class, 'login']);

Route::post('/create-orders', [BookingController::class, 'createOrder']);

Route::middleware(\App\Http\Middleware\AdminAuthMiddleware::class)->group(function () {
    Route::post('/upload-image', [ProductController::class, 'uploadImage']);
    Route::delete('/delete-image', [ProductController::class, 'deleteImage']);
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
    Route::post('/banner-besar', [ProductController::class, 'createBannerBesar']); // Create
    Route::put('/banner-besar/{id}', [ProductController::class, 'updateBannerBesar']); // Update
    Route::delete('/banner-besar/{id}', [ProductController::class, 'deleteBannerBesar']); // Delete
    Route::put('/banner-best-product/{id}', [ProductController::class, 'updateBannerBestProduct']); // Update

});

Route::get('/test-middleware', function() {
    return response()->json(['message' => 'Middleware is working']);
})->middleware(\App\Http\Middleware\AdminAuthMiddleware::class);

