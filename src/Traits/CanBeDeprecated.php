<?php

namespace AutoDocumentation\Traits;

trait CanBeDeprecated
{
    protected bool $deprecated = false;

    public function deprecated(bool $deprecated = true): static
    {
        $this->deprecated = $deprecated;

        return $this;
    }
}