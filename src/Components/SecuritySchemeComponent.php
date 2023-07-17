<?php

namespace AutoDocumentation\Components;

use AutoDocumentation\Enums\ComponentType;
use AutoDocumentation\SecuritySchemes\SecurityScheme;

abstract class SecuritySchemeComponent extends Component
{
    public function type(): ComponentType
    {
        return ComponentType::securitySchemes;
    }

    public function name(): string
    {
        return $this->content()->name;
    }

    public function resolve(): array
    {
        return [$this->content()->name => []];
    }

    abstract public function content(): SecurityScheme;
}