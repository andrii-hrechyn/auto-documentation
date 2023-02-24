<?php

namespace AutoDocumentation\Http\Controllers;

use AutoDocumentation\Documentation;
use Illuminate\Support\Facades\File;

class SpecificationController
{
    public function __invoke(Documentation $documentation)
    {
        $generatedDocPath = rtrim(config('auto-documentation.paths.generated-doc'), '/').'/documentation.yaml';

        if (File::exists($generatedDocPath)) {
            $documentation->generate();
        }

        return response()->file($generatedDocPath, ['Content-type' => 'text/x-yaml']);
    }
}