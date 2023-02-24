<?php

namespace AutoDocumentation\Properties;

use AutoDocumentation\Schemas\Schema;

abstract class PrimitiveProperty extends Property
{
    public static function make(string $name): static
    {
        return new static($name, static::schema());
    }

    abstract protected static function schema(): Schema;
}