<?php

namespace AutoDocumentation\Schemas;

use AutoDocumentation\Enums\Type;
use AutoDocumentation\Properties\Property;
use Illuminate\Support\Arr;

class ObjectSchema extends Schema
{
    /**
     * @var array<Property>
     */
    private array $properties;

    /**
     * @param array<Property> $properties
     *
     * @return static
     */
    public static function make(array $properties = []): static
    {
        return new static($properties);
    }

    public function __construct(array $properties = [])
    {
        $this->type = Type::object;
        $this->properties = $properties;
    }

    public function add(Property $property): static
    {
        $this->properties[] = $property;

        return $this;
    }

    protected function additionalFields(): array
    {
        return [
            'properties' => Arr::collapse(array_map(fn(Property $property) => $property->resolve(), $this->properties)),
        ];
    }
}