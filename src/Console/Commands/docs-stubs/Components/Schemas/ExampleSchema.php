<?php

namespace Docs\Components\Schemas;

use AutoDocumentation\Components\SchemaComponent;
use AutoDocumentation\Properties\StringProperty;
use AutoDocumentation\Schemas\ObjectSchema;

class ExampleSchema extends SchemaComponent
{
    public function name(): string
    {
        return 'Example';
    }

    public function content(): ObjectSchema
    {
        return ObjectSchema::make([
            StringProperty::make('stringProperty'),
            StringProperty::make('stringProperty2'),
        ]);
    }
}