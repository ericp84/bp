<?php

namespace App\Providers;

use Domains\Secret\Models\Secret;
use Domains\Secret\Observers\SecretObserver;
use Illuminate\Support\ServiceProvider;

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
        Secret::observe(SecretObserver::class);
    }
}
