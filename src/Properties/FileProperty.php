<?php

namespace AutoDocumentation\Properties;

class FileProperty extends StringProperty
{
    public static function make(string $name): static
    {
        return parent::make($name)->format('binary');
    }
}
