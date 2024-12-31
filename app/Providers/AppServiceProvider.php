<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

use App\Repositories\CategoryRepository;
use App\Services\CategoryService;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\Interfaces\CategoryServiceInterface;

use App\Repositories\DishRepository;
use App\Services\DishService;
use App\Repositories\Interfaces\DishRepositoryInterface;
use App\Services\Interfaces\DishServiceInterface;

use App\Repositories\BookingRepository;
use App\Services\BookingService;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Services\Interfaces\BookingServiceInterface;

use App\Repositories\OrderRepository;
use App\Services\OrderService;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\Interfaces\OrderServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);

        $this->app->bind(BookingRepositoryInterface::class, BookingRepository::class);
        $this->app->bind(BookingServiceInterface::class, BookingService::class);

        $this->app->bind(DishRepositoryInterface::class, DishRepository::class);
        $this->app->bind(DishServiceInterface::class, DishService::class);

        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(OrderServiceInterface::class, OrderService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        if (app()->environment('production')) {
            URL::forceScheme('https'); // Принудительное использование HTTPS
        }
    }
}
