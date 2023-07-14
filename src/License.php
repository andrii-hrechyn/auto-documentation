<?php

namespace AutoDocumentation;

class License
{
    public function __construct(
        protected readonly string $name,
        protected readonly ?string $url = null
    ) {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'url'  => $this->url,
        ];
    }
}