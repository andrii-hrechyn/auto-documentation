<?php

namespace AutoDocumentation\Traits;

use AutoDocumentation\Components\Component;
use AutoDocumentation\Components\ComponentsRegistry;

trait ComponentConverts
{
    protected ComponentsRegistry $componentsRegistry;

    protected function setRegistry(ComponentsRegistry $componentsRegistry): void
    {
        $this->componentsRegistry = $componentsRegistry;
    }

    protected function convertComponentToRef(Component $component): array
    {
        $this->componentsRegistry->register($component);

        return [
            '$ref' => $component->ref(),
        ];
    }
}
