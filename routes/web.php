<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

// Authentication routes
Route::get('login', [DashboardController::class, 'showLogin'])->name('login');
Route::post('login', [DashboardController::class, 'login']);
Route::get('register', [DashboardController::class, 'showRegister'])->name('register');
Route::post('register', [DashboardController::class, 'register']);
Route::post('logout', [DashboardController::class, 'logout'])->name('logout');

// Guarded Admin routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Products CRUD
    Route::prefix('products')->group(function () {
        Route::get('/', [DashboardController::class, 'products'])->name('admin.products');
        Route::get('create', [DashboardController::class, 'createProduct'])->name('admin.products.create');
        Route::post('store', [DashboardController::class, 'storeProduct'])->name('admin.products.store');
        Route::get('{id}/edit', [DashboardController::class, 'editProduct'])->name('admin.products.edit');
        Route::post('{id}/update', [DashboardController::class, 'updateProduct'])->name('admin.products.update');
        Route::post('{id}/delete', [DashboardController::class, 'deleteProduct'])->name('admin.products.delete');
    });

    // Sales Monitor
    Route::get('orders', [DashboardController::class, 'orders'])->name('admin.orders');
});

// Root Route
Route::get('/', function () {
    return redirect()->route('login');
});
