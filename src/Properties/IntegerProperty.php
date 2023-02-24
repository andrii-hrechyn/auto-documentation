<?php

namespace AutoDocumentation\Properties;

use AutoDocumentation\Schemas\IntegerSchema;
use AutoDocumentation\Schemas\Schema;

/**
 * @method self minimum(int $minimum)
 * @method self maximum(int $maximum)
 *
 * @see IntegerSchema
 */
class IntegerProperty extends PrimitiveProperty
{
    protected static function schema(): Schema
    {
        return IntegerSchema::make();
    }
}