<?php

namespace Tuta\Terbilang;

use Illuminate\Support\ServiceProvider;

class TerbilangServiceProvider extends ServiceProvider
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
      $this->app->bind('terbilang',function($app){
        return new Terbilang($app);
      });
      $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Terbilang', 'Tuta\Terbilang\Facades\TerbilangFacade');
        });
    }
}
