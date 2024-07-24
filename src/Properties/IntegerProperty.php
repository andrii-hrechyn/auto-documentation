<?php

namespace AutoDocumentation\Properties;

use AutoDocumentation\Schemas\IntegerSchema;

/**
 * @method self minimum(int $minimum)
 * @method self maximum(int $maximum)
 *
 * @see IntegerSchema
 */
class IntegerProperty extends PrimitiveProperty
{
    public static function make(string $name): static
    {
        return new static($name, IntegerSchema::make());
    }
}
