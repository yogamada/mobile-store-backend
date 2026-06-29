<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\OrderApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    
    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
    });
});

Route::middleware('auth:api')->group(function () {
    // Products (Authenticated users can view products)
    Route::get('products', [ProductApiController::class, 'index']);
    Route::get('products/{id}', [ProductApiController::class, 'show']);

    // Orders (Customer only)
    Route::prefix('orders')->group(function () {
        Route::post('/', [OrderApiController::class, 'checkout']);
        Route::get('/', [OrderApiController::class, 'history']);
    });
});
