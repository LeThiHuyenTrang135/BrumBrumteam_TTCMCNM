<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductCategoryController;









Route::prefix('admin')->group(function () {
    Route::resource('user', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('product', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('product-category', \App\Http\Controllers\Admin\ProductCategoryController::class);
    Route::resource('order', \App\Http\Controllers\Admin\OrderController::class, ['only' => ['index', 'show', 'destroy']]);
    Route::get('/admin/order/confirm/{id}', [OrderController::class, 'confirm'])->name('order.confirm');
Route::get('/admin/order/show/{id}', [OrderController::class, 'show'])->name('order.show');
Route::delete('/admin/order/{id}', [OrderController::class, 'destroy'])->name('order.destroy');

});
