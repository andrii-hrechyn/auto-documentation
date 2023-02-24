<?php

namespace AutoDocumentation\Components;

use AutoDocumentation\Enums\ComponentType;
use AutoDocumentation\Parameters\Parameter;

abstract class ParameterComponent extends Component
{
    public function type(): ComponentType
    {
        return ComponentType::parameters;
    }

    public function name(): string
    {
        return $this->content()->name;
    }

    abstract public function content(): Parameter;
}