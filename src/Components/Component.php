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

    protected function register(): void
    {
        ComponentsRegistry::instance()->register($this);
    }

    public function toArray(): array
    {
        return [
            '$ref' => $this->ref(),
        ];
    }
}
