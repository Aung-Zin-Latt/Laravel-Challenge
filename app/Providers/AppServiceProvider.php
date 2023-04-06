<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\InternetServiceProvider\InternetServiceProviderInterface;
use App\Services\InternetServiceProvider\Mpt;
use App\Services\InternetServiceProvider\Ooredoo;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(InternetServiceProviderInterface::class, function ($app) {
            // Return the concrete implementation that you want to use
            // Here we are returning Mpt as the default service provider
            return new Mpt();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
