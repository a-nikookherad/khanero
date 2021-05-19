<?php

namespace App\Modules\Week;

use Illuminate\Support\ServiceProvider;

class WeekProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__."/Migration");
        $this->loadRoutesFrom(__DIR__."/Route/route.php");
        $this->loadViewsFrom(__DIR__."/View","Week");
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
