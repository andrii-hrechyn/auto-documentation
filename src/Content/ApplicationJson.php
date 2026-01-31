<?php

namespace AutoDocumentation\Content;

use AutoDocumentation\Components\SchemaComponent;
use AutoDocumentation\Schemas\Schema;

class ApplicationJson
{
    public static function make(Schema|SchemaComponent|array $schema): Content
    {
        return Content::make('application/json')->schema($schema);
    }
}
