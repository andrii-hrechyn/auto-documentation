<?php

namespace AutoDocumentation\Components;

use AutoDocumentation\Enums\ComponentType;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;

abstract class Component implements Arrayable
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

    public function toArray(): array
    {
        ComponentsRegistry::instance()->register($this);

        return [
            '$ref' => $this->ref(),
        ];
    }
}
