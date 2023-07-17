<?php

namespace AutoDocumentation;

class ExternalDocs
{
    public static function make(string $url, string $description = ''): self
    {
        return OpenApi::instance()->externalDocs(new self($url, $description));
    }

    private function __construct(
        protected readonly string $url,
        protected readonly string $description = ''
    ) {
    }

    public function toArray(): array
    {
        return [
            'url'         => $this->url,
            'description' => $this->description,
        ];
    }
}