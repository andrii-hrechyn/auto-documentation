<?php

namespace AutoDocumentation;

use AutoDocumentation\Traits\HasDescription;
use AutoDocumentation\Traits\HasEnum;
use AutoDocumentation\Traits\HasName;
use Illuminate\Contracts\Support\Arrayable;

class Variable implements Arrayable
{
    use HasName;
    use HasEnum;
    use HasDescription;

    protected string|int|float|bool $default;

    public static function make(string $name, string|int|float|bool $default): static
    {
        return new static($name, $default);
    }

    public function __construct(string $name, string|int|float|bool $default)
    {
        $this->name($name);
        $this->default = $default;
    }

    public function getDefault(): string|int|float|bool|null
    {
        return $this->default;
    }

    public function toArray(): array
    {
        return [
            'default'     => $this->getDefault(),
            'enum'        => $this->getEnum(),
            'description' => $this->getDescription(),
        ];
    }
}
