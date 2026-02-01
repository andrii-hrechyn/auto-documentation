<?php

namespace AutoDocumentation\Schemas;

abstract class PrimitiveSchema extends Schema
{
    public static function make(): static
    {
        return new static();
    }
}
