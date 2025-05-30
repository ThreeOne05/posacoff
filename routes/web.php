<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CashierController;

// Route untuk root URL (modifikasi/tambahan)
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Produk dengan filter kategori
    Route::get('/products/category/{type}', [ProductController::class, 'filterByCategory'])->name('products.category');

    // Resource Produk & Order
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);

    // POS (Point of Sale)
    Route::get('/pos', [OrderController::class, 'pos'])->name('pos');
    Route::post('/pos/add-item', [OrderController::class, 'addItem'])->name('pos.add-item');
    Route::post('/pos/complete', [OrderController::class, 'complete'])->name('pos.complete');

    // Routes tambahan untuk keranjang pembayaran di sidebar:
    Route::delete('/pos/remove-item/{key}', [OrderController::class, 'removeItem'])->name('pos.remove-item');
    Route::delete('/pos/clear-cart', [OrderController::class, 'clearCart'])->name('pos.clear-cart');

    // Route checkout/bayar sekarang (kalau kamu punya halaman khusus)
    Route::get('/pos/checkout', [OrderController::class, 'checkout'])->name('pos.checkout');

    // Resource Cashier (kasir)
    Route::resource('cashiers', CashierController::class);
});