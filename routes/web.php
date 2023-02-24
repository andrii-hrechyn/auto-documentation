<?php

use AutoDocumentation\Http\Controllers\DocumentationController;
use AutoDocumentation\Http\Controllers\SpecificationController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

if (App::environment(['local', 'development', 'testing'])) {
    Route::get(config('auto-documentation.routes.documentation'), DocumentationController::class)
        ->name('auto-documentation.documentation');

    Route::get(config('auto-documentation.routes.specification'), SpecificationController::class)
        ->name('auto-documentation.specification');
}
