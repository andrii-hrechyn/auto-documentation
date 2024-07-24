<?php

namespace AutoDocumentation\Schemas;

use AutoDocumentation\Enums\Type;

class BooleanSchema extends PrimitiveSchema
{
    public function __construct()
    {
        $this->type = Type::BOOLEAN;
    }
}
