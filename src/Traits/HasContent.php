<?php

namespace AutoDocumentation\Traits;

use Illuminate\Support\Collection;

trait HasContent
{
    protected array $content = [];

    public function content(array $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getContent(): Collection
    {
        return collect($this->content);
    }
}
