<?php

namespace AutoDocumentation;

use AutoDocumentation\Traits\HasDescription;
use AutoDocumentation\Traits\HasExtensions;
use AutoDocumentation\Traits\HasUrl;
use Illuminate\Contracts\Support\Arrayable;

class ExternalDocs implements Arrayable
{
    use HasUrl;
    use HasDescription;
    use HasExtensions;

    public function __construct(string $url)
    {
        $this->url($url);
    }

    public static function make(string $url): static
    {
        return new static($url);
    }

    public function toArray(): array
    {
        return [
            'url'         => $this->getUrl(),
            'description' => $this->getDescription(),
            ...$this->getExtensions(),
        ];
    }
}
