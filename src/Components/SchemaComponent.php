<?php

namespace AutoDocumentation\Components;

use AutoDocumentation\Enums\ComponentType;
use AutoDocumentation\Schemas\ObjectSchema;
use AutoDocumentation\Schemas\Schema;

abstract class SchemaComponent extends SimpleComponent
{
    public function type(): ComponentType
    {
        return ComponentType::SCHEMA;
    }

    protected function schema(array $properties = []): ObjectSchema
    {
        return ObjectSchema::make($properties);
    }

    abstract public function content(): Schema;
}
