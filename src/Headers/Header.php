<?php

namespace AutoDocumentation\Headers;

class Header
{
    protected ?string $description = null;
    protected bool $required = false;
    protected bool $deprecated = false;

    public function description(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function required(): self
    {
        $this->required = true;

        return $this;
    }

    public function deprecated(): self
    {
        $this->deprecated = true;

        return $this;
    }
}