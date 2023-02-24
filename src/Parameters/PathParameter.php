<?php

namespace AutoDocumentation\Parameters;

class PathParameter extends Parameter
{
    public static function make(string $name, string $in = 'path'): static
    {
        return parent::make($name, $in);
    }
}