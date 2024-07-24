<?php

namespace AutoDocumentation\Traits;

trait HasRequired
{
    protected bool $required = false;

    public function required($required = true): static
    {
        $this->required = $required;

        return $this;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }
}
