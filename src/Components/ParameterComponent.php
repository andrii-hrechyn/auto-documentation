<?php

namespace AutoDocumentation\Components;

use AutoDocumentation\Enums\ComponentType;
use AutoDocumentation\Enums\ParameterIn;
use AutoDocumentation\Parameter;

abstract class ParameterComponent extends SimpleComponent
{
    public function type(): ComponentType
    {
        return ComponentType::PARAMETER;
    }

    public function getName(): string
    {
        return $this->content()->getName();
    }

    protected function parameter(string $name, ParameterIn $in): Parameter
    {
        return Parameter::make($name, $in);
    }

    abstract public function content(): Parameter;
}
