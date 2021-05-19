<?php

namespace App\Modules\Sms;

use Illuminate\Support\ServiceProvider;

class SmsProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__."/View", "Sms");
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
