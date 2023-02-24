<?php

namespace AutoDocumentation\Schemas;

use AutoDocumentation\Enums\Type;

class BooleanSchema extends PrimitiveSchema
{
    protected function getType(): Type
    {
        return Type::boolean;
    }
}