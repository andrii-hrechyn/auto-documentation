<?php

namespace AutoDocumentation\Traits;

use AutoDocumentation\Contracts\Resolvable;
use AutoDocumentation\Paths\Path;

trait PathResolver
{
    protected function resolvePaths(array $paths): array
    {
        $resolvedPaths = [];

        /** @var Path $path */
        foreach ($paths as $path) {
            $resolvedPaths[$path->path][$path->method] = $this->resolvePath($path);
        }

        return $resolvedPaths;
    }

    private function resolvePath(Path $path): array
    {
        $parameters = $path->getParameters()->map(fn(Resolvable $resolvable) => $resolvable->resolve());
        $responses = $path->getResponses()->mapWithKeys(fn(Resolvable $resolvable) => $resolvable->resolve());

        return [
            'summary'    => $path->summary,
            'tags'       => $path->getTags(),
            'parameters' => $parameters->toArray(),
            ...$this->requestBody($path),
            'responses'  => $responses->toArray(),
            ...$this->security($path),
        ];
    }

    private function requestBody(Path $path): array
    {
        if (!$path->getRequestBody()) {
            return [];
        }

        return [
            'requestBody' => $path->getRequestBody()->resolve(),
        ];
    }

    private function security(Path $path): array
    {
        if (!$path->getSecurity()) {
            return [];
        }

        return [
            'security' => [
                [$path->getSecurity() => []],
            ],
        ];
    }
}