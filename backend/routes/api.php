<?php

use App\Http\Controllers\Api\OrderController as ApiOrder;
use App\Http\Controllers\Api\ProductController as ApiProduct;
use Illuminate\Support\Facades\Route;

// API untuk aplikasi mobile
Route::prefix('v1')->group(function () {
    Route::get('/products', [ApiProduct::class, 'index']);
    Route::get('/products/{slug}', [ApiProduct::class, 'show']);
    Route::post('/orders', [ApiOrder::class, 'store']);
});
