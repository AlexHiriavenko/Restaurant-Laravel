<?php

namespace App\Providers;


use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Policies\UserPolicy;
use App\Policies\DishPolicy;
use App\Policies\ReservationPolicy;
use App\Policies\OrderPolicy;

use App\Models\User;
use App\Models\Dish;
use App\Models\Reservation;
use App\Models\Order;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Reservation::class => ReservationPolicy::class,
        Order::class => OrderPolicy::class,
        User::class => UserPolicy::class,
        Dish::class => DishPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url') . "/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        // Настройка Gate для проверки разрешений
        Gate::define('manage_all_orders', function (User $user) {
            return $user->hasPermission('manage_all_orders');
        });

        Gate::define('manage_reservations', function (User $user) {
            return $user->hasPermission('manage_reservations');
        });

        Gate::define('manage_dishes', function (User $user) {
            return $user->hasPermission('manage_dishes');
        });

        Gate::define('view_reports', function (User $user) {
            return $user->hasPermission('view_reports');
        });

        Gate::define('manage_users', function (User $user) {
            return $user->hasPermission('manage_users');
        });
    }
}
