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
Route::middleware(['auth'])->prefix('cart')->group(function () {
    Route::get('/', [App\Http\Controllers\Front\CartController::class, 'index'])->name('cart.index');
    Route::match(['get', 'post'], 'add', [App\Http\Controllers\Front\CartController::class, 'add'])->name('cart.add');
    Route::get('delete', [App\Http\Controllers\Front\CartController::class, 'delete'])->name('cart.delete');
    Route::get('update', [App\Http\Controllers\Front\CartController::class, 'update'])->name('cart.update');
    Route::get('destroy', [App\Http\Controllers\Front\CartController::class, 'destroy'])->name('cart.destroy');
});

Route::prefix('account')->group(function () {
    Route::get('login', [App\Http\Controllers\Front\AccountController::class, 'login'])->name('login');
    Route::post('login', [App\Http\Controllers\Front\AccountController::class, 'checkLogin']);
    Route::get('logout', [App\Http\Controllers\Front\AccountController::class, 'logout']);
    Route::get('register', [App\Http\Controllers\Front\AccountController::class, 'register']);
    Route::post('register', [App\Http\Controllers\Front\AccountController::class, 'postRegister']);

    Route::prefix('my-order')->group(function () {
        Route::get('/', [App\Http\Controllers\Front\AccountController::class, 'myOrderIndex']);
        Route::get('{id}', [App\Http\Controllers\Front\AccountController::class, 'myOrderShow']);

    });
    Route::get('google', [App\Http\Controllers\Front\AccountController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('google/callback', [App\Http\Controllers\Front\AccountController::class, 'handleGoogleCallback']);

    Route::get('github', [App\Http\Controllers\Front\AccountController::class, 'redirectToGithub'])->name('login.github');
    Route::get('github/callback', [App\Http\Controllers\Front\AccountController::class, 'handleGithubCallback']);

    Route::get('login-phone', [App\Http\Controllers\Front\AccountController::class, 'loginPhone'])->name('login.phone');
    Route::post('send-otp', [App\Http\Controllers\Front\AccountController::class, 'sendOtp'])->name('login.send_otp');
    
    Route::get('verify-otp', [App\Http\Controllers\Front\AccountController::class, 'verifyOtp'])->name('login.verify_otp');
    Route::post('check-otp', [App\Http\Controllers\Front\AccountController::class, 'checkOtp'])->name('login.check_otp');
    
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
