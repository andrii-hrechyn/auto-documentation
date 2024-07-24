<?php

namespace AutoDocumentation\Properties;

class DateTimeProperty extends StringProperty
{
    public static function make(string $name): static
    {
        return parent::make($name)->format('date-time');
    }
}
