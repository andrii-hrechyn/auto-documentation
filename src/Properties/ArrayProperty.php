<?php

namespace AutoDocumentation\Properties;

use AutoDocumentation\Components\SchemaComponent;
use AutoDocumentation\Helpers\SchemaHelper;
use AutoDocumentation\Schemas\ArraySchema;
use AutoDocumentation\Schemas\Schema;

/**
 * @method self maxItems(int $minimum)
 * @method self minItems(int $maximum)
 *
 * @see IntegerSchema
 */
class ArrayProperty extends Property
{
    public static function make(string $name, SchemaComponent|Schema $items): static
    {
        if ($items instanceof Schema || $items instanceof SchemaComponent) {
            $items = ArraySchema::make($items);
        }

        return new static($name, SchemaHelper::prepareSchema($items));
    }
}