<?php

namespace AutoDocumentation;

use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Yaml\Yaml;

class Documentation
{
    protected Filesystem $filesystem;
    protected Normalizer $normalizer;

    public function __construct(Filesystem $filesystem, Normalizer $normalizer)
    {
        $this->filesystem = $filesystem;
        $this->normalizer = $normalizer;
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

    public function store(OpenApi $api, string $path): void
    {
        $this->filesystem->ensureDirectoryExists(dirname($path));

        $this->filesystem->put($path, $this->generateYaml($api));
    }

    public function generateYaml(OpenApi $api): string
    {
        return Yaml::dump($this->normalizer->normalize($api->toArray()), 25, 2, Yaml::DUMP_EMPTY_ARRAY_AS_SEQUENCE);
    }
}
