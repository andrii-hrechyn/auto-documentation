<?php

namespace AutoDocumentation\Properties;

use AutoDocumentation\Schemas\NumberSchema;

/**
 * @method self minimum(int $minimum)
 * @method self maximum(int $maximum)
 *
 * @see NumberSchema
 */
class NumberProperty extends IntegerProperty
{
    public static function make(string $name): static
    {
        return new static($name, NumberSchema::make());
    }
}
