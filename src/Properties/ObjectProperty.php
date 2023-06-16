<?php

namespace AutoDocumentation\Properties;

use AutoDocumentation\Components\SchemaComponent;
use AutoDocumentation\Helpers\SchemaHelper;
use AutoDocumentation\Schemas\Schema;

class ObjectProperty extends Property
{
    public static function make(string $name, SchemaComponent|Schema|array $properties): static
    {
        return new static($name, SchemaHelper::prepareSchema($properties));
    }
}