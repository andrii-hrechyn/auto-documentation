<?php

namespace AutoDocumentation\Traits;

trait HasDescription
{
    protected ?string $description = null;

    public function description(string $description): static
    {
        $this->description = $description;

        return $this;
    }
}