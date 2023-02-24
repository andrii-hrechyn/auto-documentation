<?php

namespace AutoDocumentation\Properties;

use AutoDocumentation\Schemas\Schema;
use AutoDocumentation\Schemas\StringSchema;

/**
 * @method self minLength(int $minLength)
 * @method self maxLength(int $maxLength)
 *
 * @see StringSchema
 */
class StringProperty extends PrimitiveProperty
{
    protected static function schema(): Schema
    {
        return StringSchema::make();
    }
}