<?php

namespace AutoDocumentation\Properties;

use AutoDocumentation\Schemas\Schema;
use AutoDocumentation\Traits\CanBeRequired;

/**
 * @method self title(string $title)
 * @method self format(string $format)
 * @method self enum(array|string $enum)
 * @method self default($default)
 * @method self description(string $description)
 *
 * @see Schema
 */
class Property
{
    use CanBeRequired;

    protected string $name;
    protected Schema $schema;

    public function __construct(string $name, Schema $schema)
    {
        $this->name = $name;
        $this->schema = $schema;
    }

    public function resolve(): array
    {
        return [
            $this->name => $this->schema->resolve(),
        ];
    }

    public function __call(string $method, array $arguments): static
    {
        $this->schema->{$method}(...$arguments);

        return $this;
    }
}