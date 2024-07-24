<?php

namespace AutoDocumentation\Traits;

trait HasUrl
{
    protected ?string $url = null;

    public function url(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
