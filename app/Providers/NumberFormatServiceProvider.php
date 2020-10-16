<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class NumberFormatServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('currency', function () {
            return new \NumberFormatter('pt-BR', \NumberFormatter::CURRENCY);
        });

        $this->app->singleton('decimal', function () {
            return new \NumberFormatter('pt-BR', \NumberFormatter::DECIMAL);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
