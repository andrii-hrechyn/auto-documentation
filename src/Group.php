<?php

namespace AutoDocumentation;

class Group
{
    public function __construct(
        public readonly string $name,
        public readonly array $tags
    ) {
    }

    public function toArray()
    {
        return [
            'name' => ucfirst($this->name),
            'tags' => array_map(fn(string $tag) => ucfirst($tag), $this->tags),
        ];
    }
}