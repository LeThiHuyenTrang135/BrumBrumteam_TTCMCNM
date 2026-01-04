<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ShopController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductCategoryController;


Route::get('/', [App\Http\Controllers\Front\HomeController::class, 'index']);

Route::prefix('shop')->group(function () {
    Route::get('product/{id}', [ShopController::class, 'show']);
    Route::post('product/{id}/comment', [ShopController::class, 'postComment'])
        ->name('product.comment');

    Route::post('product/{id}', [ShopController::class, 'postComment'])->name('shop.postComment');


});

//ADMIN
Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('user', UserController::class);
        Route::resource('product', ProductController::class);
        Route::resource('product-category', ProductCategoryController::class);
        Route::resource('order', OrderController::class)
            ->only(['index', 'show', 'destroy']);
        
        Route::patch('order/confirm/{order}', [OrderController::class, 'confirm'])
    ->name('order.confirm');


        Route::delete('product/image/{imageId}', [ProductController::class, 'deleteImage'])
            ->name('product.image.delete');
});
