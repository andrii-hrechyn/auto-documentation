<?php

namespace AutoDocumentation\Parameters;

class QueryParameter extends Parameter
{
    public static function make(string $name, string $in = 'query'): static
    {
        return parent::make($name, $in);
    }
}