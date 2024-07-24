<?php

namespace AutoDocumentation\Paths;

use Illuminate\Support\Collection;

class PathsCollection
{
    protected array $paths = [];

    public function add(Path $path): static
    {
        $this->paths[$path->getPath()] = $path;

        return $this;
    }

    public function toArray(): array
    {
        return $this->paths;
    }

    public function toLaravelCollection(): Collection
    {
        return collect($this->paths);
    }
}
