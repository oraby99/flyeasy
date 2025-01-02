<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\ChannelObserver;
use App\Observers\UserObserver;
use App\Models\Channel;
use App\Models\User;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        User::observe(UserObserver::class);
        Channel::observe(ChannelObserver::class);
    }
}
