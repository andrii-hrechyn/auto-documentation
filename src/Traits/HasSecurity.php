<?php

namespace AutoDocumentation\Traits;

use AutoDocumentation\Security\SecurityRequirement;
use Illuminate\Support\Collection;

trait HasSecurity
{
    protected array $security = [];

    public function security(SecurityRequirement $security): static
    {
        $this->security[] = $security;

        return $this;
    }

    public function getSecurity(): Collection
    {
        return collect($this->security);
    }
}
