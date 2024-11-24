<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CartController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function () {
    // Authentication routes
    Route::post('login', [\App\Http\Controllers\Api\AuthenticationController::class, 'store']);
    Route::post('logout', [\App\Http\Controllers\Api\AuthenticationController::class, 'destroy'])->middleware('auth:api');
    Route::post('register', [\App\Http\Controllers\Api\AuthenticationController::class, 'register']);
    Route::post('updateprofile', [\App\Http\Controllers\Api\ProfileController::class, 'updateProfile'])->middleware('auth:api');
    Route::post('forgot-password', [\App\Http\Controllers\Api\AuthenticationController::class, 'forgotPassword']);
    Route::post('reset-password', [\App\Http\Controllers\Api\AuthenticationController::class, 'resetPassword']);

    // Product routes
    Route::get('products', [\App\Http\Controllers\Api\ProductController::class, 'getAllProduct']);
    Route::get('products/{id}', [\App\Http\Controllers\Api\ProductController::class, 'show']);

    // Cart routes
    Route::get('cart', [\App\Http\Controllers\Api\CartController::class, 'index']); // Lấy danh sách giỏ hàng
    Route::post('cart/add', [\App\Http\Controllers\Api\CartController::class, 'add']); // Thêm sản phẩm vào giỏ hàng
    Route::put('cart/update/{id}', [\App\Http\Controllers\Api\CartController::class, 'update']); // Cập nhật số lượng sản phẩm
    Route::delete('cart/{id}', [\App\Http\Controllers\Api\CartController::class, 'remove']); // Xóa sản phẩm khỏi giỏ hàng
    Route::delete('cart/clear', [\App\Http\Controllers\Api\CartController::class, 'clear']); // Xóa toàn bộ giỏ hàng
    Route::post('cart/checkout', [\App\Http\Controllers\Api\CartController::class, 'checkout']);
});

