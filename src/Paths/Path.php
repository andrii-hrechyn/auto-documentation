<?php

namespace AutoDocumentation\Paths;

use AutoDocumentation\OpenApi;

/**
 * @method static Path get(string $path, string $summary)
 * @method static Path post(string $path, string $summary)
 * @method static Path patch(string $path, string $summary)
 * @method static Path put(string $path, string $summary)
 * @method static Path delete(string $path, string $summary)
 * @method static Path option(string $path, string $summary)
 */
class Path extends BasePath
{
    public static function make(string $method, string $path, string $summary): Path
    {
        return OpenApi::instance()->registryPath(new Path($method, $path, $summary));
    }

    public static function __callStatic(string $method, array $arguments)
    {
        return self::make($method, ...$arguments);
    }
}