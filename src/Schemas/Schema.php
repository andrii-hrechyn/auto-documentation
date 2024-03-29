<?php

namespace AutoDocumentation\Schemas;

use AutoDocumentation\Contracts\Resolvable;
use AutoDocumentation\Enums\Type;
use AutoDocumentation\Traits\CanBeDeprecated;
use AutoDocumentation\Traits\HasDescription;
use AutoDocumentation\Traits\HasExternalDocs;

abstract class Schema implements Resolvable
{
    use HasDescription;
    use CanBeDeprecated;
    use HasExternalDocs;

    protected Type $type;
    protected ?string $title = null;
    protected ?string $format = null;
    protected mixed $default = null;
    protected ?array $enum = null;

    protected bool $nullable = false;
    protected bool $readOnly = false;
    protected bool $writeOnly = false;
    protected ?string $example = null;

    public function title(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function format(string $format): static
    {
        $this->format = $format;

        return $this;
    }

    public function default($default): static
    {
        $this->default = $default;

        return $this;
    }

    public function enum(array|string $enum): static
    {
        if (is_string($enum)) {
            $enum = array_map(fn(\BackedEnum $e) => $e->value, $enum::cases());
        }

        $this->enum = $enum;

        return $this;
    }

    public function example(string $example): static
    {
        $this->example = $example;

        return $this;
    }

    public function resolve(): array
    {
        return [
            'type'        => $this->type->name,
            'title'       => $this->title,
            'format'      => $this->format,
            'default'     => $this->prepareDefault($this->default),
            'enum'        => $this->enum,
            'description' => $this->description,
            ...$this->additionalFields(),
        ];
    }

    protected function additionalFields(): array
    {
        return [];
    }

    protected function prepareDefault($default)
    {
        if ($default instanceof self) {
            return $default->resolve();
        }

        return $default;
    }
}