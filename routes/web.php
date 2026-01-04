<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductCategoryController;








Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('user', UserController::class);
        Route::resource('product', ProductController::class);
        Route::resource('product-category', ProductCategoryController::class);
        Route::resource('order', OrderController::class)
            ->only(['index', 'show', 'destroy']);
});
