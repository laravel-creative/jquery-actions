<?php

namespace LaravelCreative\JqueryAction;

use Illuminate\Support\ServiceProvider;
use LaravelCreative\JqueryAction\Helpers\JqueryHelper;

class JqueryActionServiceProvider extends ServiceProvider
{

    use JqueryActionBladesTrait;
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
         $this->loadViewsFrom(__DIR__.'/views', 'jquery-actions');
         $this->loadRoutesFrom(__DIR__ . '/routes.php');

         $this->registerDirective();

    }

    /**
     * Register the application services.
     */
    public function register()
    {

        // Register the main class to use with the facade
        $this->app->singleton('jquery-action', function () {
            return new JqueryAction;
        });

        // Register the main class to use with the facade
        $this->app->singleton('jquery-helper', function () {
            return new JqueryHelper;
        });
    }
}
