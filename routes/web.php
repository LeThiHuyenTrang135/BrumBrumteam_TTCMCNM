<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;

Route::get('/', [App\Http\Controllers\Front\HomeController::class, 'index'] );
