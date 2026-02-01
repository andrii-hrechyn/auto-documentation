<?php

namespace AutoDocumentation\Content;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

class ContentCollection implements Arrayable
{
    protected Collection $content;

    public function __construct(array $content = [])
    {
        $this->content = new Collection();

        foreach ($content as $item) {
            $this->add($item);
        }
    }

    public function add(Content $content): static
    {
        $this->content[$content->getName()] = $content;

        return $this;
    }

    public function toArray(): array
    {
        return $this->content->toArray();
    }
}
