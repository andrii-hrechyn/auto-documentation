<?php

namespace AutoDocumentation\Components;

class ComponentsRegistry
{
    protected array $components = [];
    protected static ?self $instance = null;

    private function __construct()
    {
    }

    public static function instance(): self
    {
        if (self::$instance) {
            return self::$instance;
        }

        return self::$instance = new self();
    }

    public function register(Component $component): static
    {
        $this->components[$component->type()->value][$component->getName()] = $component->content()->toArray();

        return $this;
    }

    public function toArray(): array
    {
        return $this->components;
    }
}
