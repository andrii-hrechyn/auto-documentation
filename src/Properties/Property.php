<?php

namespace AutoDocumentation\Properties;

use AutoDocumentation\JsonSchema;
use AutoDocumentation\Schemas\Schema;
use AutoDocumentation\Traits\HasName;
use AutoDocumentation\Traits\HasRequired;
use AutoDocumentation\Traits\HasSchema;

/**
 * @method self title(string $title)
 * @method self format(string $format)
 * @method self enum(array|string $enum)
 * @method self default($default)
 * @method self description(string $description)
 * @method self example(string $example)
 *
 * @see Schema
 */
class Property extends JsonSchema
{
    use HasName;
    use HasRequired;
    use HasSchema;

    public function __construct(string $name, Schema $schema)
    {
        $this->name($name);
        $this->schema($schema);
    }

    public function __call(string $method, array $arguments): static
    {
        $this->getSchema()->{$method}(...$arguments);

        return $this;
    }
}
