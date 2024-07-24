<?php

namespace AutoDocumentation;

use AutoDocumentation\Traits\HasDescription;
use AutoDocumentation\Traits\HasUrl;

class ExternalDocs
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
}
