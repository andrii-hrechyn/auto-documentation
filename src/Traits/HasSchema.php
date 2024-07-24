<?php

namespace AutoDocumentation\Traits;

use AutoDocumentation\Components\SchemaComponent;
use AutoDocumentation\Schemas\Schema;

trait HasSchema
{
    protected Schema|SchemaComponent $schema;

    public function schema(Schema|SchemaComponent $schema): static
    {
        $this->schema = $schema;

        return $this;
    }

    public function getSchema(): Schema|SchemaComponent
    {
        return $this->schema;
    }
}
