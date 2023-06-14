<?php

namespace AutoDocumentation\RequestBodies\MediaTypes;

use AutoDocumentation\Components\SchemaComponent;
use AutoDocumentation\RequestBodies\Content;
use AutoDocumentation\Schemas\Schema;

class MultipartFormData
{
    public static function make(Schema|SchemaComponent|array $schema): Content
    {
        return new Content('multipart/form-data', $schema);
    }
}