<?php

namespace AutoDocumentation\Http\Controllers;

class DocumentationController
{
    public function __invoke()
    {
//        if (config('api-doc.generate_always')) {
//            Artisan::call('auto-doc:generate');
//        }

        return view('auto-documentation::index');
    }
}