<?php

namespace App\Modules\MultiAuth;

use Illuminate\Support\ServiceProvider;

class MultiAuthProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/Route/route.php');

        $this->loadViewsFrom(__DIR__."/View",'MultiAuth');

        $this->loadMigrationsFrom(__DIR__.'/Migration');

        $this->publishes([
            __DIR__.'/Public/Avatar' => public_path('Modules/Profile'),
        ], 'public');

        $this->publishes([
            __DIR__.'/Config/Role.php' => config_path('Role.php'),
        ], 'public');

        $this->publishes([
            __DIR__.'/Mail/ResetPasswordLink.php' => app_path('mail/ResetPasswordLink.php'),
        ], 'public');

        $this->publishes([
            __DIR__.'/Mail/ActivationCode.php' => app_path('mail/ActivationCode.php'),
        ], 'public');

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
