<?php

namespace AutoDocumentation\Content;

use AutoDocumentation\Components\SchemaComponent;
use AutoDocumentation\Schemas\Schema;

class MultipartFormData
{
    public static function make(Schema|SchemaComponent|array $schema): Content
    {
        return Content::make('multipart/form-data')->schema($schema);
    }
}
