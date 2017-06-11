<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Form;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        /*
        //@deleteButton('string')
        Blade::directive('deleteButton', function ($args) {
            $result = $args;
            return $result;
        });
        */
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        \App::bind('Illuminate\Routing\ResourceRegistrar', function ()
        {
            return \App::make('App\Providers\ResourceNoPrefixRegistrar');
        });
    }
}
