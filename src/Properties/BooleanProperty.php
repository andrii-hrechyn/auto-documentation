<?php

namespace AutoDocumentation\Properties;

use AutoDocumentation\Schemas\BooleanSchema;
use AutoDocumentation\Schemas\Schema;

class BooleanProperty extends PrimitiveProperty
{
    protected static function schema(): Schema
    {
        return BooleanSchema::make();
    }
}