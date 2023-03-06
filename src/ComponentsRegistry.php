<?php

namespace AutoDocumentation;

use AutoDocumentation\Components\Component;
use AutoDocumentation\Enums\ComponentType;

class ComponentsRegistry
{
    private static array $components = [];

    public static function set(Component $component): void
    {
        self::$components[$component->type()->name][$component->name()] = $component->content()->resolve();
    }

    public static function get(ComponentType $type, string $name): ?Component
    {
        return self::$components[$type->name][$name] ?? null;
    }

    public static function all(): array
    {
        return self::$components;
    }
}