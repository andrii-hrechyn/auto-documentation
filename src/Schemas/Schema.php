<?php

namespace AutoDocumentation\Schemas;

use AutoDocumentation\Contracts\Resolvable;
use AutoDocumentation\Enums\Type;

abstract class Schema implements Resolvable
{
    protected Type $type;
    protected ?string $title = null;
    protected ?string $format = null;
    protected mixed $default = null;
    protected ?array $enum = null;
    protected ?string $description = null;

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

    public function description(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function resolve(): array
    {
        return $this->filterEmptyValue([
            'type'        => $this->type->name,
            'title'       => $this->title,
            'format'      => $this->format,
            'default'     => $this->prepareDefault($this->default),
            'enum'        => $this->enum,
            'description' => $this->description,
            ...$this->additionalFields(),
        ]);
    }

    protected function additionalFields(): array
    {
        return [];
    }

    protected function filterEmptyValue($array): array
    {
        return array_filter($array, fn($v) => $v);
    }

    protected function prepareDefault($default)
    {
        if ($default instanceof self) {
            return $default->resolve();
        }

        return $default;
    }
}