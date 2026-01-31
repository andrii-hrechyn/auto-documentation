<?php

namespace AutoDocumentation\Properties;

use AutoDocumentation\Schemas\Schema;
use AutoDocumentation\Traits\HasName;
use AutoDocumentation\Traits\HasRequired;
use AutoDocumentation\Traits\HasSchema;
use Illuminate\Contracts\Support\Arrayable;

/**
 * @method self title(string $title)
 * @method self format(string $format)
 * @method self enum(array|string $enum)
 * @method self default($default)
 * @method self description(string $description)
 * @method self example(string $example)
 * @method self extension(string $name, mixed $value)
 *
 * @see Schema
 */
class Property implements Arrayable
{
    use HasName;
    use HasRequired;
    use HasSchema;

    public function __construct(string $name, Schema $schema)
    {
        $this->name($name);
        $this->schema($schema);
    }

    public function toArray(): array
    {
        return $this->schema->toArray();
    }

    public function __call(string $method, array $arguments): static
    {
        $this->getSchema()->{$method}(...$arguments);

        return $this;
    }
}
