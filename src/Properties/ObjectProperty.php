<?php

namespace AutoDocumentation\Properties;

use AutoDocumentation\Components\SchemaComponent;
use AutoDocumentation\Helpers\SchemaHelper;

class ObjectProperty extends Property
{
    public static function make(string $name, SchemaComponent|array $properties): static
    {
        return new static($name, SchemaHelper::prepareSchema($properties));
    }
}