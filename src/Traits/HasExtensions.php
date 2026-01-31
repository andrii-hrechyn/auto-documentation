<?php

namespace AutoDocumentation\Traits;

trait HasExtensions
{
    protected array $extensions = [];

    public function extension(string $name, mixed $value): static
    {
        $key = str_starts_with($name, 'x-') ? $name : 'x-' . $name;
        $this->extensions[$key] = $value;

        return $this;
    }

    public function getExtensions(): array
    {
        return $this->extensions;
    }
}
