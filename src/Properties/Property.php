<?php

namespace AutoDocumentation\Properties;

use AutoDocumentation\Schemas\Schema;

/**
 * @method self title(string $title)
 * @method self format(string $format)
 * @method self enum(array|string $enum)
 * @method self default($default)
 * @method self description(string $description)
 *
 * @see Schema
 */
abstract class Property
{
    protected string $name;
    protected Schema $schema;
    protected bool $required = false;

    public function __construct(string $name, Schema $schema)
    {
        $this->name = $name;
        $this->schema = $schema;
    }

    public function required(): static
    {
        $this->required = true;

        return $this;
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