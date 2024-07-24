<?php

namespace AutoDocumentation\Components;

use AutoDocumentation\Enums\ComponentType;
use Illuminate\Support\Str;

abstract class Component
{
    public function ref(): string
    {
        return "#/components/{$this->type()->value}/{$this->getName()}";
    }

    public function getName(): string
    {
        return Str::of(static::class)->afterLast('\\')->replace('Component', '');
    }

    abstract public function type(): ComponentType;

    abstract public function content();
}
