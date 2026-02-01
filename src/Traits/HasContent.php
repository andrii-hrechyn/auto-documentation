<?php

namespace AutoDocumentation\Traits;

use AutoDocumentation\Content\Content;
use AutoDocumentation\Content\ContentCollection;
use Illuminate\Support\Arr;

trait HasContent
{
    protected ContentCollection $content;

    public function content(array|Content|ContentCollection $content): static
    {
        $this->content = $content instanceof ContentCollection
            ? $content
            : new ContentCollection(Arr::wrap($content));

        return $this;
    }

    public function getContent(): ContentCollection
    {
        return $this->content ?? new ContentCollection();
    }
}
