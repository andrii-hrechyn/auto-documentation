<?php

namespace AutoDocumentation\Traits;

trait HasFormat
{
    protected ?string $format = null;

    public function format(string $title): static
    {
        $this->format = $title;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }
}
