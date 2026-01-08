<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Services\Product\ProductServiceInterface;
use App\Services\Product\ProductService;
use App\Repositories\ProductComment\ProductCommentRepositoryInterface;
use App\Repositories\ProductComment\ProductCommentRepository;
use App\Services\ProductComment\ProductCommentServiceInterface;
use App\Services\ProductComment\ProductCommentService;
use App\Repositories\ProductCategory\ProductCategoryRepositoryInterface;
use App\Repositories\ProductCategory\ProductCategoryRepository;
use App\Services\ProductCategory\ProductCategoryServiceInterface;
use App\Services\ProductCategory\ProductCategoryService;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\Brand\BrandRepository;
use App\Services\Brand\BrandServiceInterface;
use App\Services\Brand\BrandService;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Repositories\Blog\BlogRepository;
use App\Services\Blog\BlogServiceInterface;
use App\Services\Blog\BlogService;

use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Services\User\UserServiceInterface;
use App\Services\User\UserService;

use App\Services\Order\OrderServiceInterface;
use App\Services\Order\OrderService;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Order\OrderRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Product
        $this->app->singleton(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->singleton(
            ProductServiceInterface::class,
            ProductService::class
        );

        //ProductComment
        $this->app->singleton(
            ProductCommentRepositoryInterface::class,
            ProductCommentRepository::class
        );

        $this->app->singleton(
            ProductCommentServiceInterface::class,
            ProductCommentService::class
        );

        //ProductCategory
        $this->app->singleton(
            ProductCategoryRepositoryInterface::class,
            ProductCategoryRepository::class
        );

        $this->app->singleton(
            ProductCategoryServiceInterface::class,
            ProductCategoryService::class
        );

        //Brand
        $this->app->singleton(
            BrandRepositoryInterface::class,
            BrandRepository::class
        );

        $this->app->singleton(
            BrandServiceInterface::class,
            BrandService::class
        );

        //Blog
        $this->app->singleton(
            BlogRepositoryInterface::class,
            BlogRepository::class
        );

        $this->app->singleton(
            BlogServiceInterface::class,
            BlogService::class
        );

        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        );
//user
        $this->app->singleton(
            UserServiceInterface::class,
            UserService::class
        );

        //order
        $this->app->singleton(
            OrderRepositoryInterface::class,
            OrderRepository::class
        );

        $this->app->singleton(
            OrderServiceInterface::class,
            OrderService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
