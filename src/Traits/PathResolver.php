<?php

namespace AutoDocumentation\Traits;

use AutoDocumentation\Contracts\Resolvable;
use AutoDocumentation\Paths\BasePath;

trait PathResolver
{
    protected function preparePaths(array $paths): array
    {
        $resolvedPaths = [];

        /** @var BasePath $path */
        foreach ($paths as $path) {
            $resolvedPaths[$path->path][$path->method] = $this->resolvePath($path);
        }

        return $resolvedPaths;
    }

    private function resolvePath(BasePath $path): array
    {
        $parameters = $path->getParameters()->map(fn(Resolvable $resolvable) => $resolvable->resolve());
        $responses = $path->getResponses()->mapWithKeys(fn(Resolvable $resolvable) => $resolvable->resolve());

        return [
            'summary'     => $path->summary,
            'tags'        => $path->getTags(),
            'parameters'  => $parameters->toArray(),
            'requestBody' => $path->getRequestBody()?->resolve(),
            'responses'   => $responses->toArray(),
            'security'    => $path->getSecurity() ? [$path->getSecurity()->resolve()] : null,
        ];
    }
}