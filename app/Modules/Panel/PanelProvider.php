<?php

namespace App\Modules\Panel;

use Illuminate\Support\ServiceProvider;

class PanelProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/View','Panel');

        $this->loadRoutesFrom(__DIR__.'/Route/route.php');
    }
}
