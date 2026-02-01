<?php

namespace AutoDocumentation\Traits;

use AutoDocumentation\Components\ParameterComponent;
use AutoDocumentation\Parameter;
use Illuminate\Support\Collection;

trait HasParameters
{
    protected array $parameters = [];

    public function parameter(Parameter|ParameterComponent $parameter): static
    {
        $this->parameters[$parameter->getName()] = $parameter;

        return $this;
    }

    public function getParameters(): Collection
    {
        return collect($this->parameters);
    }
}
