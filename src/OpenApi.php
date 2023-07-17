<?php

namespace AutoDocumentation;

use AutoDocumentation\Components\SecuritySchemeComponent;
use AutoDocumentation\Paths\BasePath;
use AutoDocumentation\Traits\ComponentResolver;
use AutoDocumentation\Traits\PathResolver;
use Illuminate\Filesystem\Filesystem;

class OpenApi
{
    use PathResolver, ComponentResolver, GroupsAggregator;

    const OPEN_API_VERSION = '3.1.0';

    private static self $instance;
    protected Loader $loader;
    protected Filesystem $filesystem;

    protected Info $info;
    protected array $servers = [];

    protected array $paths = [];
    protected array $components = [];
    protected array $security = [];
    protected ?ExternalDocs $externalDocs = null;
    /*
     * Applied for all route marked as secure ( "secure" method in Path object without parameter )
     */
    protected ?SecuritySchemeComponent $defaultSecurityScheme = null;

    protected array $ignoreEmptyValueFiltering = [
        'security',
    ];

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

    public function info(Info $info): Info
    {
        $this->info = $info;

        return $info;
    }

    public function server(Server $server): Server
    {
        $this->servers[] = $server;

        return $server;
    }

    public function setDefaultSecurityScheme(SecuritySchemeComponent $securityScheme): self
    {
        $this->defaultSecurityScheme = $securityScheme;

        return $this;
    }

    public function setSecurity(SecuritySchemeComponent $securityScheme): self
    {
        $this->security[] = $securityScheme;

        return $this;
    }

    public function externalDocs(ExternalDocs $externalDocs): ExternalDocs
    {
        $this->externalDocs = $externalDocs;

        return $externalDocs;
    }

    public function getDefaultSecurityScheme(): ?SecuritySchemeComponent
    {
        return $this->defaultSecurityScheme;
    }

    public function path(BasePath $path): BasePath
    {
        $this->paths[] = $path;

        return $path;
    }

    public function generate(): array
    {
        return $this->filterEmptyValue([
            'openapi'      => self::OPEN_API_VERSION,
            'info'         => $this->info->toArray(),
            'servers'      => $this->prepareServers($this->servers),
            'paths'        => $this->preparePaths($this->paths),
            'components'   => ComponentsRegistry::all(),
            'security'     => $this->prepareSecurity($this->security),
            'externalDocs' => $this->externalDocs->toArray(),
            'x-tagGroups'  => $this->groupsFromPaths($this->paths),
        ]);
    }

    public static function defaultSecurityScheme(SecuritySchemeComponent $securitySchemeComponent): self
    {
        return self::instance()->setDefaultSecurityScheme($securitySchemeComponent);
    }

    public static function security(SecuritySchemeComponent $securitySchemeComponent): self
    {
        return self::instance()->setSecurity($securitySchemeComponent);
    }

    private function prepareServers(array $servers): array
    {
        return array_map(fn(Server $server) => $server->toArray(), $servers);
    }

    private function prepareSecurity(array $securities): array
    {
        return array_map(fn(SecuritySchemeComponent $security) => $security->resolve(), $securities);
    }

    private function filterEmptyValue(array $array): array
    {
        return collect($array)
            ->map(function ($value, string $key) {
                if (in_array($key, $this->ignoreEmptyValueFiltering)) {
                    return $value;
                }

                if (is_array($value)) {
                    return empty($value) ? null : $this->filterEmptyValue($value);
                }

                return $value;
            })
            ->filter(fn($value) => $value)->all();
    }
}