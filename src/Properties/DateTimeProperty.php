<?php

namespace AutoDocumentation\Properties;

use AutoDocumentation\Schemas\Schema;

class DateTimeProperty extends StringProperty
{
    protected static function schema(): Schema
    {
        return parent::schema()->format('date-time');
    }
}