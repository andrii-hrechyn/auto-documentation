<?php

namespace AutoDocumentation;

use AutoDocumentation\OpenApi as OpenApiAlias;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Yaml\Yaml;

class Documentation
{
    protected Filesystem $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function generate($a): void
    {
//        $this->loadPaths(config('auto-documentation.paths.source'));

        $this->store($a, config('auto-documentation.paths.generated-doc').'/documentation.yaml');
    }

    public function loadPaths(string $documentationPath)
    {
        (new Loader($this->filesystem))->load($documentationPath);
    }

    public function store(OpenApiAlias $api, string $path): void
    {
        $this->filesystem->ensureDirectoryExists(dirname($path));

        $this->filesystem->put($path, $this->generateYaml($api));
    }

    public function generateYaml(OpenApiAlias $api): string
    {
        return Yaml::dump($api->generate(), 25, 2, Yaml::DUMP_EMPTY_ARRAY_AS_SEQUENCE);
    }
}
