<?php

namespace AutoDocumentation;

use AutoDocumentation\Traits\HasDescription;
use AutoDocumentation\Traits\HasUrl;
use Illuminate\Contracts\Support\Arrayable;

class ExternalDocs implements Arrayable
{
    use HasUrl;
    use HasDescription;

    public function __construct(string $url)
    {
        $this->url($url);
    }

    public function make(string $url): static
    {
        return new static($url);
    }

    public function toArray(): array
    {
        return [
            'url'         => $this->getUrl(),
            'description' => $this->getDescription(),
        ];
    }
}
