<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ShopController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Front\AccountController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckOutController;
use App\Http\Controllers\Front\StripeController;
use App\Http\Controllers\Webhook\StripeWebhookController;
use App\Http\Controllers\Front\ChatbotController;

Route::get('/', [HomeController::class, 'index']);

Route::prefix('shop')->group(function () {
    Route::get('product/{id}', [ShopController::class, 'show']);
    Route::post('product/{id}/comment', [ShopController::class, 'postComment'])
        ->name('product.comment');

    Route::post('product/{id}', [ShopController::class, 'postComment'])->name('shop.postComment');
        Route::get('', [App\Http\Controllers\Front\ShopController::class, 'index']);

    Route::get('category/{categoryName}', [App\Http\Controllers\Front\ShopController::class, 'category']);
});

Route::middleware(['auth'])->prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::match(['get', 'post'], 'add', [CartController::class, 'add'])->name('cart.add');
    Route::get('delete', [CartController::class, 'delete'])->name('cart.delete');
    Route::get('update', [CartController::class, 'update'])->name('cart.update');
    Route::get('destroy', [CartController::class, 'destroy'])->name('cart.destroy');
});

Route::prefix('account')->group(function () {
    Route::get('login', [AccountController::class, 'login'])->name('login');
    Route::post('login', [AccountController::class, 'checkLogin']);
    Route::get('logout', [AccountController::class, 'logout']);
    Route::get('register', [AccountController::class, 'register'])->name('register');
    Route::post('register', [AccountController::class, 'postRegister']);

    Route::get('verify', [AccountController::class, 'showVerifyForm'])->name('verify.form');
    Route::post('verify', [AccountController::class, 'verifyEmail'])->name('verify');
    Route::post('resend-code', [AccountController::class, 'resendCode'])->name('resend.code');

    Route::prefix('my-order')->group(function () {
        Route::get('/', [AccountController::class, 'myOrderIndex'])->name('myOrderIndex');
        Route::get('{id}', [AccountController::class, 'myOrderShow']);
    });
    Route::get('google', [AccountController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('google/callback', [AccountController::class, 'handleGoogleCallback']);

    Route::get('github', [AccountController::class, 'redirectToGithub'])->name('login.github');
    Route::get('github/callback', [AccountController::class, 'handleGithubCallback']);

    Route::get('login-phone', [AccountController::class, 'loginPhone'])->name('login.phone');
    Route::post('send-otp', [AccountController::class, 'sendOtp'])->name('login.send_otp');

    Route::get('verify-otp', [AccountController::class, 'verifyOtp'])->name('login.verify_otp');
    Route::post('check-otp', [AccountController::class, 'checkOtp'])->name('login.check_otp');
});

Route::post('/chatbot/ask', [ChatbotController::class, 'chat'])->name('chatbot.ask');

//ADMIN
// ADMIN
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        // USER
        Route::resource('user', UserController::class);

        // PRODUCT
        Route::resource('product', ProductController::class);
        Route::delete(
            'product/image/{imageId}',
            [ProductController::class, 'deleteImage']
        )->name('product.image.delete');

        // PRODUCT CATEGORY
        Route::resource('product-category', ProductCategoryController::class);

        // ORDER (base)
        Route::resource('order', OrderController::class)
            ->only(['index', 'show', 'destroy']);

        // ORDER STATUS ACTIONS
        Route::patch(
            'order/{order}/confirm',
            [OrderController::class, 'confirm']
        )->name('order.confirm');

        Route::patch(
            'order/{order}/delivered',
            [OrderController::class, 'delivered']
        )->name('order.delivered');

        Route::patch(
            'order/{order}/complete',
            [OrderController::class, 'complete']
        )->name('order.complete');
    });

//Checkout

Route::prefix('checkout')->group(function () {
    Route::get('', [App\Http\Controllers\Front\CheckOutController::class, 'index']);
    Route::post('/', [App\Http\Controllers\Front\CheckOutController::class, 'addOrder']);
    Route::get('/result', [App\Http\Controllers\Front\CheckOutController::class, 'result']);

    Route::get('/vnPayCheck', [App\Http\Controllers\Front\CheckOutController::class, 'vnPayCheck']);
});

/// Stripe Routes
Route::get('/stripe/index', [StripeController::class, 'index'])
    ->name('stripe.index');

Route::post('/stripe/webhook', [StripeWebhookController::class, 'handle']);

Route::post('/stripe/checkout', [StripeController::class, 'checkout'])
    ->name('stripe.checkout');

Route::get('/stripe/success', [StripeController::class, 'success'])
    ->name('stripe.success');
Route::get('/stripe/cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');

Route::post('/checkout/pay-later', [CheckOutController::class, 'addOrder'])
    ->name('checkout.pay_later');