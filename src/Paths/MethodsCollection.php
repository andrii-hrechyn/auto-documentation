<?php

namespace AutoDocumentation\Paths;

use Illuminate\Support\Collection;

class MethodsCollection
{
    protected Collection $methods;

    public function __construct()
    {
        $this->methods = new Collection();
    }

    public function add(Method $method): static
    {
        $this->methods[$method->getMethod()] = $method;

        return $this;
    }

    public function all(): Collection
    {
        return $this->methods;
    }

    public function toArray(): array
    {
        return $this->methods->toArray();
    }
}
