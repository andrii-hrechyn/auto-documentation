<?php

namespace AutoDocumentation;

use AutoDocumentation\Components\Component;
use AutoDocumentation\SecuritySchemes\SecurityScheme;

class Container
{
    public static Info $info;
    public static array $servers = [];
    public static ?SecurityScheme $securityScheme = null;
    public static array $components = [
        'responses'  => [],
        'parameters' => [],
        'schemas'    => [],
    ];
    public static array $paths = [];

    public function registerPath()
    {

    }

    public static function componentExists(Component $component): bool
    {
        return isset(self::$components[$component->type()->name][$component->name()]);
    }

    public static function registerComponent(Component $component): void
    {
        if (static::componentExists($component)) {
            return;
        }

        self::$components[$component->type()->name][$component->name()] = $component->content()->resolve();
    }
}