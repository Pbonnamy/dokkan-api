<?php

namespace App\Providers;

use App\Clients\DokkanClient;
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
        $this->app->bind(DokkanClient::class, function () {
            $config = config('services.dokkan');
            return new DokkanClient($config['url'], $config['version']);
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
