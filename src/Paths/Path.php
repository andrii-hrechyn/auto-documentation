<?php

namespace AutoDocumentation\Paths;

use AutoDocumentation\Traits\HasDescription;
use AutoDocumentation\Traits\HasServers;
use AutoDocumentation\Traits\HasSummary;
use Illuminate\Contracts\Support\Arrayable;

class Path implements Arrayable
{
    use HasSummary;
    use HasDescription;
    use HasServers;

    protected string $path;

    protected MethodsCollection $methods;

    public function __construct(string $path)
    {
        $this->path = $path;

        $this->methods = new MethodsCollection();
    }

    public static function make(string $path): static
    {
        return new static($path);
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function method(Method $method): static
    {
        $this->methods->add($method);

        return $this;
    }

    public function methods(array $methods): static
    {
        foreach ($methods as $method) {
            $this->methods->add($method);
        }

        return $this;
    }

    public function getMethods(): MethodsCollection
    {
        return $this->methods;
    }

    public function toArray(): array
    {
        return [
            ...$this->getMethods()->toArray(),
            'summary'     => $this->getSummary(),
            'description' => $this->getDescription(),
            'servers'     => $this->getServers()->values()->toArray(),
            //todo add parameters
//            'parameters'
        ];
    }
}
