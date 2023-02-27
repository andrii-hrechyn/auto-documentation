<?php

namespace AutoDocumentation;

use AutoDocumentation\Paths\BasePath;
use AutoDocumentation\SecuritySchemes\SecurityScheme;
use AutoDocumentation\Traits\ComponentResolver;
use AutoDocumentation\Traits\PathResolver;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Yaml\Yaml;

class OpenApi
{
    use PathResolver, ComponentResolver, GroupsAggregator;

    const OPEN_API_VERSION = '3.1.0';

    private static self $instance;
    protected Loader $loader;
    protected Filesystem $filesystem;

    protected Info $info;
    protected array $servers = [];
    protected ?SecurityScheme $securitySchemes = null;
    protected array $paths = [];

    private function __construct()
    {
    }

    public static function instance(): self
    {
        if (isset(self::$instance)) {
            return self::$instance;
        }

        return self::$instance = new self();
    }

    public function registerInfo(Info $info): Info
    {
        $this->info = $info;

        return $info;
    }

    public function registerServer(Server $server): Server
    {
        $this->servers[] = $server;

        return $server;
    }

    public function registerSecuritySchemes(SecurityScheme $securityScheme): SecurityScheme
    {
        $this->securitySchemes = $securityScheme;

        return $securityScheme;
    }

    public function defaultSecurityScheme(): SecurityScheme
    {
        return $this->securitySchemes;
    }

    public function registryPath(BasePath $path): BasePath
    {
        $this->paths[] = $path;

        return $path;
    }

    public function generate(): array
    {
        return [
            'openapi'     => self::OPEN_API_VERSION,
            'info'        => $this->info->toArray(),
            'x-tagGroups' => $this->groupsFromPaths($this->paths),
            'servers'     => $this->prepareServers($this->servers),
            'paths'       => $this->resolvePaths($this->paths),
            'components'  => [
                ...$this->resolveComponents(ComponentsRegistry::all()),
                'securitySchemes' => $this->securitySchemes?->resolve(),
            ],
        ];
    }

    private function prepareServers(array $servers): array
    {
        return array_map(fn(Server $server) => $server->toArray(), $servers);
    }

    public function load(string $documentationPath): void
    {
        $this->loader->load($documentationPath);
    }

    public function setLoader(Loader $loader): void
    {
        $this->loader = $loader;
    }

    public function setFilesystem(Filesystem $filesystem): void
    {
        $this->filesystem = $filesystem;
    }

    public function generateYaml(): string
    {
        return Yaml::dump($this->generate(), 25, 2, Yaml::DUMP_EMPTY_ARRAY_AS_SEQUENCE);
    }

    public function storeDocumentation(string $path): void
    {
        $this->filesystem->ensureDirectoryExists(dirname($path));

        $this->filesystem->put($path, $this->generateYaml());
    }
}