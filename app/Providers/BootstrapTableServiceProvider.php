<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BootstrapTableServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path(). '/Helpers/BootstrapTable.php';
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
