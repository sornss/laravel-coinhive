<?php

namespace Springbuck\LaravelCoinhive;

use Illuminate\Support\ServiceProvider;

class CoinhiveServiceProvider extends ServiceProvider{

	/**
    * Indicates if loading of the provider is deferred.
    *
    * @var bool
    */	
    protected $defer = false;


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(){
        // ROUTES
        $this->loadRoutesFrom(__DIR__.'/routes/coinhive.php');
        
        // CONFIGS
        $this->publishes([
            __DIR__.'/coinhive.php' => config_path('coinhive.php'),
        ], 'coinhive-config');

        // DATABASE: Migrations
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->publishes([
            __DIR__.'/database/migrations' => database_path('migrations')
        ], 'coinhive-migrations');

        // DATABASE: Seeds
        $this->publishes([
            __DIR__.'/database/seeds' => database_path('seeds')
        ], 'coinhive-seeders');
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register(){
        // MERGE CONFIG
        $this->mergeConfigFrom(
            __DIR__.'/coinhive.php', 'coinhive'
        );
        
        // Console Command 
        $this->commands([
            \Springbuck\LaravelCoinhive\Console\Commands\Install::class,
            \Springbuck\LaravelCoinhive\Console\Commands\UnInstall::class
        ]);
    }
}