<?php

namespace AutoDocumentation\Schemas;

use AutoDocumentation\Components\SchemaComponent;
use AutoDocumentation\Enums\Type;
use AutoDocumentation\Helpers\SchemaHelper;

class ArraySchema extends Schema
{
    private Schema $items;
    protected ?int $maxItems = null;
    protected ?int $minItems = null;
    protected bool $unique = false;

    public static function make(Schema|SchemaComponent $items): static
    {
        return new static(SchemaHelper::prepareSchema($items));
    }

    public function __construct(Schema $items = null)
    {
        $this->type = Type::array;
        $this->items = $items;
    }

    public function maxItems(int $maximum): static
    {
        $this->maxItems = $maximum;

        return $this;
    }

    public function minItems(int $minimum): static
    {
        $this->minItems = $minimum;

        return $this;
    }

    public function unique(): static
    {
        $this->unique = true;

        return $this;
    }

    protected function additionalFields(): array
    {
        return [
            'items'       => $this->items->resolve(),
            'maxItems'    => $this->maxItems,
            'minItems'    => $this->minItems,
            'uniqueItems' => $this->unique,
        ];
    }
}