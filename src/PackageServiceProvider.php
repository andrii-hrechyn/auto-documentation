<?php

declare(strict_types=1);

namespace AutoDocumentation;

use AutoDocumentation\Console\Commands\GenerateDocumentation;
use AutoDocumentation\Console\Commands\Install;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

final class PackageServiceProvider extends ServiceProvider
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
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    protected function routeConfiguration()
    {
        return [
            'prefix' => config('blogpackage.prefix'),
            'middleware' => config('blogpackage.middleware'),
        ];
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
    }
}