<?php

namespace AutoDocumentation\Schemas;

use AutoDocumentation\Enums\Type;

abstract class PrimitiveSchema extends Schema
{
    public static function make(): static
    {
        return new static();
    }

    public function __construct()
    {
        $this->type = $this->getType();
    }

    abstract protected function getType(): Type;
}