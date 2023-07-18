<?php

declare(strict_types=1);

namespace AutoDocumentation;

use AutoDocumentation\Console\Commands\GenerateDocumentation;
use AutoDocumentation\Console\Commands\Install;
use Illuminate\Support\ServiceProvider;

final class AutoDocumentationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }

        $this->mergeConfigFrom(__DIR__.'/../config/auto-documentation.php', 'auto-documentation');
        $this->loadViewsFrom(__DIR__.'/../views', 'auto-documentation');
        $this->registerRoutes();
    }

    public function register()
    {
        $this->commands([
            Install::class,
            GenerateDocumentation::class,
        ]);
    }

    protected function registerRoutes()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__.'/../config/auto-documentation.php' => config_path('auto-documentation.php'),
        ], 'auto-documentation');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/autoDocumentation'),
        ]);
    }
}