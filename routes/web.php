<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ShopController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckOutController;
use App\Http\Controllers\Front\AccountController;
use App\Http\Controllers\Admin\UserController;



Route::get('/', [HomeController::class, 'index']);





Route::prefix('admin')->group(function () {
    Route::resource('user', \App\Http\Controllers\Admin\UserController::class);
});
