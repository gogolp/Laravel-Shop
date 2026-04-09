<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminApiController;

use App\Http\Controllers\AdminAuthController;

Route::get('/', function () {
    return view('index');
});

Route::get('/coffee', function () {
    return view('coffee');
});

// Admin Auth Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('logout');

// Protected Admin Routes
Route::middleware('auth')->group(function () {
    Route::get('/admin', function () {
        return view('admin');
    });

    Route::prefix('api/admin')->group(function () {
        Route::get('/categories', [AdminApiController::class, 'getCategories']);
        Route::post('/categories', [AdminApiController::class, 'storeCategory']);
        Route::put('/categories/{id}', [AdminApiController::class, 'updateCategory']);
        Route::delete('/categories/{id}', [AdminApiController::class, 'destroyCategory']);

        Route::get('/menu', [AdminApiController::class, 'getProducts']);
        Route::post('/menu', [AdminApiController::class, 'storeProduct']);
        Route::put('/menu/{id}', [AdminApiController::class, 'updateProduct']);
        Route::delete('/menu/{id}', [AdminApiController::class, 'destroyProduct']);

        Route::get('/news', [AdminApiController::class, 'getNews']);
        Route::post('/news', [AdminApiController::class, 'storeNews']);
        Route::put('/news/{id}', [AdminApiController::class, 'updateNews']);
        Route::delete('/news/{id}', [AdminApiController::class, 'destroyNews']);

        Route::get('/promos', [AdminApiController::class, 'getPromotions']);
        Route::post('/promos', [AdminApiController::class, 'storePromotion']);
        Route::put('/promos/{id}', [AdminApiController::class, 'updatePromotion']);
        Route::delete('/promos/{id}', [AdminApiController::class, 'destroyPromotion']);
    });
});
