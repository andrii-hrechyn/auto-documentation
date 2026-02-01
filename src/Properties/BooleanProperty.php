<?php

namespace AutoDocumentation\Properties;

use AutoDocumentation\Schemas\BooleanSchema;

class BooleanProperty extends PrimitiveProperty
{
    public static function make(string $name): static
    {
        return new static($name, BooleanSchema::make());
    }
}
