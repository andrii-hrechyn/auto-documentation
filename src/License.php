<?php

namespace AutoDocumentation;

use AutoDocumentation\Traits\HasExtensions;
use AutoDocumentation\Traits\HasName;
use AutoDocumentation\Traits\HasUrl;
use Illuminate\Contracts\Support\Arrayable;

class License implements Arrayable
{
    use HasName;
    use HasUrl;
    use HasExtensions;

    public function __construct(string $name)
    {
        $this->name($name);
    }

    public static function make(string $name): static
    {
        return new static($name);
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->getName(),
            'url'  => $this->getUrl(),
            ...$this->getExtensions(),
        ], fn ($value) => $value !== null);
    }
}
