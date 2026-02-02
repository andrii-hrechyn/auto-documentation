<?php

namespace AutoDocumentation;

use AutoDocumentation\Base\PathComponent;
use AutoDocumentation\Security\SecurityRequirement;
use Illuminate\Filesystem\Filesystem;
use ReflectionClass;

abstract class BaseDocumentation
{
    use GroupsAggregator;

    protected OpenApi $openApi;
    protected array $paths = [];

    public function __construct()
    {
        $this->openApi = new OpenApi();
    }

    abstract protected function info(): Info;

    protected function servers(): array
    {
        return [];
    }

    protected function defaultSecuritySchema(): ?SecurityRequirement
    {
        return null;
    }

    public function additionalOptions(): void
    {
    }

    protected function loadPaths(string $path)
    {
        $this->discoverPaths(doc_path('Paths'), 'Docs\\Paths');
    }

    public function discoverPaths(string $in, string $for): static
    {
        $this->discoverComponents(
            PathComponent::class,
            $this->paths,
            directory: $in,
            namespace: $for,
        );

        return $this;
    }

    protected function discoverComponents(
        string $baseClass,
        array &$register,
        ?string $directory,
        ?string $namespace
    ): void {
        if (blank($directory) || blank($namespace)) {
            return;
        }

        $filesystem = app(Filesystem::class);

        if ((!$filesystem->exists($directory)) && (!str($directory)->contains('*'))) {
            return;
        }

        $namespace = str($namespace);

        foreach ($filesystem->allFiles($directory) as $file) {
            $variableNamespace = $namespace->contains('*') ? str_ireplace(
                ['\\'.$namespace->before('*'), $namespace->after('*')],
                ['', ''],
                str_replace([DIRECTORY_SEPARATOR], ['\\'], (string) str($file->getPath())->after(base_path())),
            ) : null;

            if (is_string($variableNamespace)) {
                $variableNamespace = (string) str($variableNamespace)->before('\\');
            }

            $class = (string) $namespace
                ->append('\\', $file->getRelativePathname())
                ->replace('*', $variableNamespace ?? '')
                ->replace([DIRECTORY_SEPARATOR, '.php'], ['\\', '']);

            if (!class_exists($class)) {
                continue;
            }

            if ((new ReflectionClass($class))->isAbstract()) {
                continue;
            }

            if (!is_subclass_of($class, $baseClass)) {
                continue;
            }

            if (
                method_exists($class, 'isDiscovered') &&
                (!$class::isDiscovered())
            ) {
                continue;
            }

            $register[$file->getRealPath()] = app($class);
        }
    }

    public function resolveOpenApi(): OpenApi
    {
        $this->openApi->info($this->info());
        $this->openApi->servers($this->servers());

        if ($defaultSecurity = $this->defaultSecuritySchema()) {
            $this->openApi->security($defaultSecurity);
        }

        $this->additionalOptions();

        $this->loadPaths('');

        $resolvedPaths = [];

        collect($this->paths)->each(function (PathComponent $path) use (&$resolvedPaths) {
            $openApiPath = $path->path();

            $this->openApi->path($openApiPath);

            $openApiPath->methods($path->methods());

            $resolvedPaths[] = $openApiPath;
        });

        $groups = $this->groupsFromPaths($resolvedPaths);

        if (!empty($groups)) {
            $this->openApi->extension('x-tagGroups', $groups);
        }

        return $this->openApi;
    }
}
