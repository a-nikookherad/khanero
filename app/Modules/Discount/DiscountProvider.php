<?php

namespace App\Modules\Discount;

use Illuminate\Support\ServiceProvider;

class DiscountProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__."/View","Discount");
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
