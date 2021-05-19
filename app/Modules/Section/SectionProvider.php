<?php

namespace App\Modules\Section;

use Illuminate\Support\ServiceProvider;

class SectionProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__."/View","Section");
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
