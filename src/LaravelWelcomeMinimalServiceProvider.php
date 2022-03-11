<?php

namespace Oxedition\LaravelWelcomeMinimal;

use Illuminate\Support\ServiceProvider;
use Oxedition\LaravelWelcomeMinimal\Console\InstallCommand;

class LaravelWelcomeMinimalServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-welcome-minimal');
        //$this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-welcome-minimal');
      
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('minimal.php'),
            ], 'laravel-welcome-minimal-config');

            // Publishing the views.
            $this->publishes([
                __DIR__.'/../resources/views/' => resource_path('views/'),
            ], 'laravel-welcome-minimal-views');

            $this->publishes([
                __DIR__.'/../resources/components/' => resource_path('views/components/ox/'),
            ], 'laravel-welcome-minimal-components'); 
            
            $this->publishes([
                __DIR__.'/../resources/public/' => public_path('/'),
            ], 'laravel-welcome-minimal-images');             

            // Publishing assets.
            $this->publishes([
                 __DIR__.'/../resources/css' => resource_path('css/'),
            ], 'laravel-welcome-minimal-css');


            // Registering package commands.
            $this->commands([
                InstallCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'minimal');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-welcome-minimal', function () {
            return new LaravelWelcomeMinimal;
        });
    }
}
