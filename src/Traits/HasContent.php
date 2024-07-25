<?php

namespace AutoDocumentation\Traits;

use AutoDocumentation\ContentCollection;

trait HasContent
{
    protected ContentCollection $content;

    public function content(array|ContentCollection $content): static
    {
        $this->content = is_array($content) ? new ContentCollection($content) : $content;

        return $this;
    }

    public function getContent(): ContentCollection
    {
        return $this->content ?? new ContentCollection();
    }
}
