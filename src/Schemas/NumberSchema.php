<?php

namespace AutoDocumentation\Schemas;

use AutoDocumentation\Enums\Type;

class NumberSchema extends IntegerSchema
{
    protected function getType(): Type
    {
        return Type::number;
    }
}