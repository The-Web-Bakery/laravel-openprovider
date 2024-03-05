<?php

namespace TheWebbakery\OpenProvider;

use Illuminate\Support\ServiceProvider;

class OpenProviderServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->offerPublishing();
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/openprovider.php',
            'laravel-openprovider'
        );
    }

    public function offerPublishing(): void
    {
        if (! function_exists('config_path')) {
            // function not available and 'publish' not relevant in Lumen
            return;
        }

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/openprovider.php' => config_path('openprovider.php'),
            ], 'openprovider-config');
        }
    }
}