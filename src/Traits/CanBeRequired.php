<?php

namespace AutoDocumentation\Traits;

trait CanBeRequired
{
    protected bool $required = false;

    public function required(bool $required = true): static
    {
        $this->required = $required;

        return $this;
    }
}