<?php

namespace Bageur\BuktiTransaksi;

use Illuminate\Support\ServiceProvider;

class BuktiTransaksiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // include __DIR__.'/routes/web.php';
        $this->app->make('Bageur\BuktiTransaksi\BuktiTransaksiController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/migration');
        $this->loadViewsFrom(__DIR__.'/view', 'bageur');
    }
}
