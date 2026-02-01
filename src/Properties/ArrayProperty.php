<?php

namespace AutoDocumentation\Properties;


use AutoDocumentation\Schemas\ArraySchema;
use AutoDocumentation\Schemas\IntegerSchema;
use AutoDocumentation\Schemas\Schema;

/**
 * @method self maxItems(int $minimum)
 * @method self minItems(int $maximum)
 *
 * @see IntegerSchema
 */
class ArrayProperty extends Property
{
    public static function make(string $name, Schema $items): static
    {
        return new static($name, ArraySchema::make($items));
    }
}
