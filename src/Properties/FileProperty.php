<?php

namespace AutoDocumentation\Properties;

use AutoDocumentation\Schemas\Schema;

class FileProperty extends StringProperty
{
    protected static function schema(): Schema
    {
        return parent::schema()->format('binary');
    }
}