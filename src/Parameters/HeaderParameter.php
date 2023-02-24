<?php

namespace AutoDocumentation\Parameters;

class HeaderParameter
{
    public static function make(string $name): Parameter
    {
        return Parameter::make($name, 'header');
    }
}