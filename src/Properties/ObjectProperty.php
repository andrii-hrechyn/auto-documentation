<?php

namespace AutoDocumentation\Properties;

use AutoDocumentation\Schemas\ObjectSchema;

class ObjectProperty extends Property
{
    public static function make(string $name): static
    {
        return new static($name, ObjectSchema::make());
    }
}
