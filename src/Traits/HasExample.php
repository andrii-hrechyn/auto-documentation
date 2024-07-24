<?php

namespace AutoDocumentation\Traits;

trait HasExample
{
    protected mixed $example = null;

    public function example(mixed $example): static
    {
        $this->example = $example;

        return $this;
    }

    public function getExample(): mixed
    {
        return $this->example;
    }
}
