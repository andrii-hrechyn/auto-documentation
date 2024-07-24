<?php

namespace AutoDocumentation\Traits;

trait HasAllowEmptyValue
{
    protected bool $allowEmptyValue = false;

    public function allowEmptyValue($allow = true): static
    {
        $this->allowEmptyValue = $allow;

        return $this;
    }

    public function isAllowEmptyValue(): bool
    {
        return $this->allowEmptyValue;
    }
}
