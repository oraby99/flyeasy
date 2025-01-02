<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('api')
                ->prefix('api/v1')
                ->name('api.v1.')
                ->namespace('App\Http\Controllers\Api\V1')
                ->group(base_path('routes/v1/api.php'));

            Route::middleware('web')
                ->name('portal.')
                ->namespace('App\Http\Controllers\Portal')
                ->group(base_path('routes/portal.php'));

            Route::middleware('web')
                ->prefix('dashboard')
                ->name('dashboard.')
                ->namespace('App\Http\Controllers\Dashboard')
                ->group(base_path('routes/dashboard.php'));
        });
    }
}
