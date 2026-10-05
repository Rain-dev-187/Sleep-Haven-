<?php

use App\Http\Controllers\Admin\AuthController as AdminAuth;
use App\Http\Controllers\Admin\OrderController as AdminOrder;
use App\Http\Controllers\Admin\ProductController as AdminProduct;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CatalogController;
use App\Http\Controllers\Web\CheckoutController;
use Illuminate\Support\Facades\Route;

// Toko
Route::get('/', [CatalogController::class, 'index'])->name('catalog.index');

Route::prefix('keranjang')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/tambah/{slug}', [CartController::class, 'add'])->name('add');
    Route::get('/hapus/{id}', [CartController::class, 'remove'])->name('remove');
});

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/pesanan-berhasil/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

// Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuth::class, 'loginForm'])->name('login');
    Route::post('/login', [AdminAuth::class, 'login'])->name('login.post');

    Route::middleware('admin')->group(function () {
        Route::post('/logout', [AdminAuth::class, 'logout'])->name('logout');
        Route::resource('products', AdminProduct::class)->except(['show']);
        Route::get('/orders', [AdminOrder::class, 'index'])->name('orders.index');
        Route::patch('/orders/{order}', [AdminOrder::class, 'update'])->name('orders.update');
    });
});
