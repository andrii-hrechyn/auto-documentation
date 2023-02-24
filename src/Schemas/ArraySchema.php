<?php

namespace AutoDocumentation\Schemas;

use AutoDocumentation\Components\SchemaComponent;
use AutoDocumentation\Enums\Type;
use AutoDocumentation\Helpers\SchemaHelper;

class ArraySchema extends Schema
{
    private Schema $items;

    public static function make(Schema|SchemaComponent $items): static
    {
        return new static(SchemaHelper::prepareSchema($items));
    }

    public function __construct(Schema $items = null)
    {
        $this->type = Type::array;
        $this->items = $items;
    }

    protected function additionalFields(): array
    {
        return [
            'items' => $this->items->resolve(),
        ];
    }
}