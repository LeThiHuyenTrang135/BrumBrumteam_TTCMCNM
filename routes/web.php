<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;









Route::prefix('admin')->group(function () {
    Route::resource('user', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('product', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('product-category', \App\Http\Controllers\Admin\ProductCategoryController::class);
    Route::resource('order', \App\Http\Controllers\Admin\OrderController::class, ['only' => ['index', 'show', 'destroy']]);
});
