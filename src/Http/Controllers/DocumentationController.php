<?php

namespace AutoDocumentation\Http\Controllers;

use AutoDocumentation\Console\Commands\Generate;
use Illuminate\Support\Facades\Artisan;

class DocumentationController
{
    public function __invoke()
    {
        if (config('auto-documentation.generate_always')) {
            Artisan::call(Generate::class);
        }

        return view('auto-documentation::index');
    }
}