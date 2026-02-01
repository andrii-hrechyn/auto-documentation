<?php

namespace AutoDocumentation;

use AutoDocumentation\Components\ComponentsRegistry;
use AutoDocumentation\Paths\Path;
use AutoDocumentation\Paths\PathsCollection;
use AutoDocumentation\Traits\HasExtensions;
use AutoDocumentation\Traits\HasExternalDocs;
use AutoDocumentation\Traits\HasSecurity;
use AutoDocumentation\Traits\HasServers;
use AutoDocumentation\Traits\HasTags;

class OpenApi
{
    use HasServers;
    use HasExternalDocs;
    use HasTags;
    use HasSecurity;
    use HasExtensions;

    public const OPEN_API_VERSION = '3.1.0';

    protected Info $info;
    protected PathsCollection $paths;

    public function __construct()
    {
        $this->info = Info::make(config('app.name', 'Auto Documentation'), 'v1');
        // todo make it more dynamic
        $this->paths = new PathsCollection();
    }

    public function info(Info $info): static
    {
        $this->info = $info;

        return $this;
    }

    public function getInfo(): Info
    {
        return $this->info;
    }

    public function path(Path $path): static
    {
        $this->paths->add($path);

        return $this;
    }

    public function paths(array $paths): static
    {
        foreach ($paths as $path) {
            $this->path($path);
        }

        return $this;
    }

    public function getPaths(): PathsCollection
    {
        return $this->paths;
    }

    public function toArray(): array
    {
        return [
            'openapi'      => static::OPEN_API_VERSION,
            'info'         => $this->getInfo()->toArray(),
            'servers'      => $this->getServers()->values()->toArray(),
            'security'     => $this->getSecurity()->toArray(),
            'tags'         => $this->getTags()->toArray(),
            'externalDocs' => $this->getExternalDocs()?->toArray(),
            'paths'        => $this->getPaths()->toArray(),
            'components'   => ComponentsRegistry::instance()->toArray(),
            ...$this->getExtensions(),
        ];
    }
}
