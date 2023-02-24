<?php

namespace AutoDocumentation\RequestBodies;

use AutoDocumentation\Components\SchemaComponent;
use AutoDocumentation\Helpers\SchemaHelper;
use AutoDocumentation\Schemas\Schema;

class Content
{
    protected Schema $schema;

    public function __construct(
        protected string $mediaType,
        Schema|SchemaComponent|array $schema,
    ) {
        $this->schema = SchemaHelper::prepareSchema($schema);
    }

    public function resolve(): array
    {
        return [
            $this->mediaType => [
                'schema' => $this->schema->resolve(),
            ],
        ];
    }
}