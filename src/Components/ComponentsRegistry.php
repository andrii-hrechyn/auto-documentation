<?php

namespace AutoDocumentation\Components;

use Illuminate\Support\Collection;

class ComponentsRegistry
{
    protected array $components = [];

    public function register(Component $component, array $resolvedComponent): static
    {
        $this->components[$component->type()->value][$component->getName()] = $resolvedComponent;

        return $this;
    }

    public function toArray(): array
    {
        return $this->components;
    }

    public function toLaravelCollection(): Collection
    {
        return collect($this->components);
    }
}
