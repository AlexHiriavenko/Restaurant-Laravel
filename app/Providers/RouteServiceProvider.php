<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware(['api', 'cors'])
                ->prefix('api')
                ->group(function () {
                    require base_path('routes/api.php');
                    require base_path('routes/auth_api.php'); // Для API
                });

            Route::middleware(['web', 'cors'])
                ->group(function () {
                    require base_path('routes/web.php');
                    require base_path('routes/auth.php'); // Для Web
                });
        });
    }
}
