<?php

namespace AutoDocumentation\Traits;

use AutoDocumentation\Paths\BasePath;

trait PathResolver
{
    protected function preparePaths(array $paths): array
    {
        /** @var BasePath $path */
        foreach ($paths as $path) {
            $resolvedPaths[$path->path][$path->method] = $path->resolve();
        }

        return $resolvedPaths ?? [];
    }
}