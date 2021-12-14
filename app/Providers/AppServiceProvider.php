<?php

namespace App\Providers;

use App\Contracts\AddressApi;
use App\Services\ViaCepApi;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Configura a API do ViaCep como padrão
        $this->app->bind(AddressApi::class, ViaCepApi::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_ENV') !== 'local') {
            \URL::forceScheme('https');
        }
    }
}
