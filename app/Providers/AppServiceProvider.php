<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Blog\BlogServiceInterface;
use App\Services\Blog\BlogService;
use App\Services\User\UserServiceInterface;
use App\Services\User\UserService;
use App\Services\Product\ProductServiceInterface;
use App\Services\Product\ProductService;
use App\Services\ProductCategory\ProductCategoryServiceInterface;
use App\Services\ProductCategory\ProductCategoryService;
use App\Services\Order\OrderServiceInterface;
use App\Services\Order\OrderService;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            BlogServiceInterface::class,
            BlogService::class
        );
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(ProductCategoryServiceInterface::class, ProductCategoryService::class);
        $this->app->bind(OrderServiceInterface::class, OrderService::class);
    }

    public function boot(): void
    {
        //
    }
}
