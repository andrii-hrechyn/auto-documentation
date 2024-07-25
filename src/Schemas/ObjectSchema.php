<?php

namespace AutoDocumentation\Schemas;

use AutoDocumentation\Enums\Type;
use AutoDocumentation\Properties\Property;
use Illuminate\Support\Collection;

class ObjectSchema extends Schema
{
    /**
     * @var array<Property>
     */
    private array $properties;

    public function __construct(array $properties = [])
    {
        $this->type = Type::OBJECT;

        foreach ($properties as $property) {
            $this->add($property);
        }
    }

    /**
     * @param array<Property> $properties
     *
     * @return static
     */
    public static function make(array $properties = []): static
    {
        return new static($properties);
    }

    public function add(Property $property): static
    {
        $this->properties[$property->getName()] = $property;

        return $this;
    }

    public function merge(array $properties): static
    {
        $this->properties = array_merge($this->properties, $properties);

        return $this;
    }

    public function getProperties(): Collection
    {
        return collect($this->properties);
    }

    public function toArray(): array
    {
        return [
            ...parent::toArray(),
            'properties' => $this->getProperties()->toArray(),
        ];
    }
}
