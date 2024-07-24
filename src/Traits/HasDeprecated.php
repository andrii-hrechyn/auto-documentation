<?php

namespace AutoDocumentation\Traits;

trait HasDeprecated
{
    protected bool $deprecated = false;

    public function deprecated($deprecated = true): static
    {
        $this->deprecated = $deprecated;

        return $this;
    }

    public function isDeprecated(): bool
    {
        return $this->deprecated;
    }
}
