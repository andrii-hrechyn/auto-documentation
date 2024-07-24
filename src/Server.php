<?php

namespace AutoDocumentation;

use AutoDocumentation\Traits\HasDescription;
use AutoDocumentation\Traits\HasVariables;

class Server
{
    use HasVariables;
    use HasDescription;

    protected string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public static function make(string $url): static
    {
        return new static($url);
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
