<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // You can register your application's service bindings here if needed.
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Use Bootstrap for pagination styling
        Paginator::useBootstrap();

        // Force HTTPS scheme in production environment
        if(config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
