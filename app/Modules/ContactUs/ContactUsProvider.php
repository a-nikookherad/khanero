<?php

namespace App\Modules\ContactUs;

use Illuminate\Support\ServiceProvider;

class ContactUsProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__."/View", "ContactUs");
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
