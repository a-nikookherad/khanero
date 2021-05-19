<?php

namespace App\Helper;

use Illuminate\Support\ServiceProvider;
use League\Flysystem\Config;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $Files =config("files.Helper");

        foreach ($Files as $Item)
        {
            if(file_exists(__DIR__.'/'.$Item.'.php')) {
                include( __DIR__.'/'.$Item.'.php');
            }
        }
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
