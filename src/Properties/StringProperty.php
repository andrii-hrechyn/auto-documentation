<?php

namespace AutoDocumentation\Properties;

use AutoDocumentation\Schemas\StringSchema;

/**
 * @method self minLength(int $minLength)
 * @method self maxLength(int $maxLength)
 *
 * @see StringSchema
 */
class StringProperty extends PrimitiveProperty
{
    public static function make(string $name): static
    {
        return new static($name, StringSchema::make());
    }
}
