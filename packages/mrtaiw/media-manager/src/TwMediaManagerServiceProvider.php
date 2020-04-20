<?php

namespace MrTaiw\MediaManager;

use Illuminate\Support\ServiceProvider;
use MrTaiw\MediaManager\MediaManager;

class TwMediaManagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/routes.php';
        }
        $this->publishes([
            __DIR__ . '/config/twmm.php' => base_path('config/twmm.php'),
        ], 'twmm_config');

        $this->loadViewsFrom(__DIR__ . '/views', 'MediaManager');
        $this->publishes([
            __DIR__ . '/views' => base_path('resources/views/vendor/MediaManager'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('mediamanager', function () {
            return new MediaManager();
        });
    }
}
