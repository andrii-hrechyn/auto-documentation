<?php

namespace AutoDocumentation\Traits;

use AutoDocumentation\Tag;
use Illuminate\Support\Collection;

trait HasTags
{
    protected array $tags = [];

    public function tag(Tag|string|array $tag): static
    {
        if (is_array($tag)) {
            foreach ($tag as $item) {
                $this->tag($item);
            }

            return $this;
        }

        if (is_string($tag)) {
            $tag = (new Tag())->name($tag);
        }

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
