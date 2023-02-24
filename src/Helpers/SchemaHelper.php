<?php

namespace AutoDocumentation\Helpers;

use AutoDocumentation\Components\SchemaComponent;
use AutoDocumentation\Schemas\ObjectSchema;
use AutoDocumentation\Schemas\Schema;

class SchemaHelper
{
    public static function prepareSchema(Schema|SchemaComponent|array $schema): Schema
    {
        if (is_array($schema)) {
            $schema = ObjectSchema::make($schema);
        }

        if ($schema instanceof SchemaComponent) {
            return $schema->reference();
        }

        return $schema;
    }
}