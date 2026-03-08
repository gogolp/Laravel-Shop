<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\LoyaltyController;
use App\Http\Controllers\Api\NewsFeedController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PromotionController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

// Без авторизації
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('verify-code', [AuthController::class, 'verifyCode']);

Route::get('catalog/products/{id}', [ProductController::class, 'show']);

Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{id}', [CategoryController::class, 'show']);

Route::get('promotions', [PromotionController::class, 'index']);
Route::get('promotions/{id}', [PromotionController::class, 'show']);

Route::get('news-feed', [NewsFeedController::class, 'index']);
Route::get('news-feed/{id}', [NewsFeedController::class, 'show']);

Route::get('locations', [LocationController::class, 'index']);
Route::get('locations/{id}', [LocationController::class, 'show']);

// З авторизацією
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('user', [AuthController::class, 'me']);
    Route::put('user', [UserController::class, 'update']);
    Route::put('user/password', [UserController::class, 'updatePassword']);
    Route::get('user/transactions', [UserController::class, 'transactions']);

    Route::get('catalog/products', [ProductController::class, 'index']);

    Route::post('loyalty/add-points', [LoyaltyController::class, 'addPoints']);
    Route::post('loyalty/redeem-points', [LoyaltyController::class, 'redeemPoints']);
    Route::get('loyalty/balance/{client_id}', [LoyaltyController::class, 'balance']);

    Route::apiResource('orders', OrderController::class);
});

// З авторизацією та правами адміна
Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    Route::post('admin/product', [ProductController::class, 'store']);
    Route::put('admin/catalog/product/{id}', [ProductController::class, 'update']);
    Route::delete('admin/catalog/product/{id}', [ProductController::class, 'destroy']);

    Route::get('admin/users', [UserController::class, 'users']);

    Route::apiResource('admin/categories', CategoryController::class)->except(['index', 'show']);

    Route::apiResource('admin/locations', LocationController::class)->except(['index', 'show']);

    Route::apiResource('admin/promotions', PromotionController::class)->except(['index', 'show']);

    Route::apiResource('admin/news-feed', NewsFeedController::class)->except(['index', 'show']);

    Route::get('admin/users/{id}', [UserController::class, 'show']);
});

