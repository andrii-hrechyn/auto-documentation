<?php

namespace AutoDocumentation\Tests;

use AutoDocumentation\AutoDocumentationServiceProvider;
use Orchestra\Testbench\TestCase;

class PackageTestCase extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            AutoDocumentationServiceProvider::class,
        ];
    }
}