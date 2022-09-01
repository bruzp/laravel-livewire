<?php

namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class ViteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\Illuminate\Foundation\Vite::class, \App\Services\ViteService::class);
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
