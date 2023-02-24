<?php

namespace AutoDocumentation\Components;

use AutoDocumentation\ComponentsRegistry;
use AutoDocumentation\Contracts\Component as ComponentInterface;
use AutoDocumentation\Contracts\Resolvable;
use AutoDocumentation\Enums\ComponentType;
use AutoDocumentation\Reference;

abstract class Component implements ComponentInterface, Resolvable
{
    public static function make(): static
    {
        return new static();
    }

    public function __construct()
    {
        ComponentsRegistry::set($this);
    }

    public function name(): string
    {
        return str_replace('\\', '', get_class($this));
    }

    abstract public function type(): ComponentType;

    abstract public function content(): Resolvable;

    public function reference(): Reference
    {
        return Reference::make("#/components/{$this->type()->name}/{$this->name()}");
    }

    public function resolve(): array
    {
        return $this->reference()->resolve();
    }
}