<?php

namespace App\Providers;

use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
