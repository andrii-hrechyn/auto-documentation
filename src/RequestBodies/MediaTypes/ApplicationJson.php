<?php

namespace AutoDocumentation\RequestBodies\MediaTypes;

use AutoDocumentation\Components\SchemaComponent;
use AutoDocumentation\RequestBodies\Content;
use AutoDocumentation\Schemas\Schema;

class ApplicationJson
{
    public static function make(Schema|SchemaComponent|array $schema): Content
    {
        return new Content('application/json', $schema);
    }
}