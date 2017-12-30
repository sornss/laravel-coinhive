<?php

namespace Springbuck\LaravelCoinhive;

use Illuminate\Support\ServiceProvider;

class CoinhiveServiceProvider extends ServiceProvider{

	/**
    * Indicates if loading of the provider is deferred.
    *
    * @var bool
    */	
    protected $defer = true;


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
        ]);
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
    }
}