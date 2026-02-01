<?php

namespace AutoDocumentation\Schemas;

use AutoDocumentation\Enums\Type;

class ArraySchema extends Schema
{
    private ?Schema $items;
    protected ?int $maxItems = null;
    protected ?int $minItems = null;
    protected bool $unique = false;

    public static function make(Schema $items): static
    {
        return (new static($items));
    }

    public function __construct(Schema $items = null)
    {
        $this->type = Type::ARRAY;
        $this->items = $items;
    }

    public function maxItems(int $maximum): static
    {
        $this->maxItems = $maximum;

        return $this;
    }

    public function getMaxItems(): ?int
    {
        return $this->maxItems;
    }

    public function minItems(int $minimum): static
    {
        $this->minItems = $minimum;

        return $this;
    }

    public function getMinItems(): ?int
    {
        return $this->minItems;
    }

    public function unique(): static
    {
        $this->unique = true;

        return $this;
    }

    public function isUnique(): bool
    {
        return $this->unique;
    }

    public function getItems(): ?Schema
    {
        return $this->items;
    }

    public function toArray(): array
    {
        return [
            ...parent::toArray(),
            'maxItems'    => $this->getMaxItems(),
            'minItems'    => $this->getMinItems(),
            'uniqueItems' => $this->isUnique(),
            'items'       => $this->getItems()->toArray(),
        ];
    }

//    protected function additionalFields(): array
//    {
//        return [
//            'items'       => $this->items->resolve(),
//            'maxItems'    => $this->maxItems,
//            'minItems'    => $this->minItems,
//            'uniqueItems' => $this->unique,
//        ];
//    }
}
