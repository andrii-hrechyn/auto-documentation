<?php

namespace AutoDocumentation;

use Illuminate\Contracts\Support\Arrayable;

class Group implements Arrayable
{
    public function __construct(
        public readonly string $name,
        public readonly array $tags
    ) {
    }

    public function toArray(): array
    {
        return [
            'name' => ucfirst($this->name),
            'tags' => array_map(fn(string $tag) => ucfirst($tag), $this->tags),
        ];
    }
}
