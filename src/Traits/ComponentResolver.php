<?php

namespace AutoDocumentation\Traits;

use AutoDocumentation\Components\Component;

trait ComponentResolver
{
    protected function resolveComponents(array $components): array
    {
        $resolved = [];

        foreach ($components as $componentType => $componentData) {
            /** @var Component $component */
            foreach ($componentData as $componentName => $component) {
                $resolved[$componentType][$componentName] = $component->content()->resolve();
            }
        }

        return $resolved;
    }
}