<?php

namespace AutoDocumentation\Traits;

trait HasName
{
    protected ?string $name = null;

    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
