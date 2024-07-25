<?php

namespace AutoDocumentation\Traits;

use AutoDocumentation\Tag;
use Illuminate\Support\Collection;

trait HasTags
{
    protected array $tags = [];

    public function tag(Tag $tag): static
    {
        $this->tags[] = $tag;

        return $this;
    }

    public function tags(array $tags): static
    {
        $this->tags = $tags;

        return $this;
    }

    public function getTags(): Collection
    {
        return collect($this->tags);
    }
}
