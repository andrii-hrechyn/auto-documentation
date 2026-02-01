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
        return array_map(function ($value) {
            if ($value instanceof \Illuminate\Contracts\Support\Arrayable) {
                return $value->toArray();
            }

            if (is_array($value)) {
                return array_map(fn ($item) => $item instanceof \Illuminate\Contracts\Support\Arrayable ? $item->toArray() : $item, $value);
            }

            return $value;
        }, $this->extensions);
    }
}
