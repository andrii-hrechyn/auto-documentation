<?php

namespace AutoDocumentation\Paths;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

class PathsCollection implements Arrayable
{
    protected Collection $paths;

    public function __construct()
    {
        $this->paths = new Collection();
    }

    public function add(Path $path): static
    {
        $this->paths[$path->getPath()] = $path;

        return $this;
    }

    public function toArray(): array
    {
        return $this->paths->toArray();
    }
}
