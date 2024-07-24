<?php

namespace AutoDocumentation\Schemas;

use AutoDocumentation\Enums\Type;

class NumberSchema extends IntegerSchema
{
    public function __construct()
    {
        $this->type = Type::NUMBER;
    }
}
