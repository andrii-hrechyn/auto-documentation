<?php

use AutoDocumentation\Paths\Path;
use Docs\Components\Parameters\ExampleParameter;
use Docs\Components\Schemas\ExampleSchema;

Path::make('get', '/your/path', 'Example path')
    ->group('My group')
    ->tag('Example path')
    ->parameters([ExampleParameter::make()])
    ->jsonRequest(ExampleSchema::make())
    ->successfulResponse(ExampleSchema::make())
    ->secure();
