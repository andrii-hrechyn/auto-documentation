<?php

namespace AutoDocumentation\Properties;

use AutoDocumentation\Schemas\NumberSchema;
use AutoDocumentation\Schemas\Schema;

/**
 * @method self minimum(int $minimum)
 * @method self maximum(int $maximum)
 *
 * @see NumberSchema
 */
class NumberProperty extends IntegerProperty
{
    protected static function schema(): Schema
    {
        return NumberSchema::make();
    }
}