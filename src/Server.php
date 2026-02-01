<?php

namespace AutoDocumentation;

use AutoDocumentation\Traits\HasDescription;
use AutoDocumentation\Traits\HasExtensions;
use AutoDocumentation\Traits\HasVariables;
use Illuminate\Contracts\Support\Arrayable;

class Server implements Arrayable
{
    use HasVariables;
    use HasDescription;
    use HasExtensions;

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

    public function toArray(): array
    {
        return [
            'url'         => $this->getUrl(),
            'description' => $this->getDescription(),
            'variables'   => $this->getVariables()->toArray(),
            ...$this->getExtensions(),
        ];
    }
}
