<?php

namespace AutoDocumentation\Traits;

trait HasSummary
{
    protected ?string $summary = null;

    public function summary(string $summary): static
    {
        $this->summary = $summary;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }
}
