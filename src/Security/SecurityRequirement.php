<?php

namespace AutoDocumentation\Security;

use AutoDocumentation\Components\SimpleComponent;
use AutoDocumentation\Enums\ComponentType;
use AutoDocumentation\Security\Schemas\SecurityScheme;

abstract class SecurityRequirement extends SimpleComponent
{
    public function type(): ComponentType
    {
        return ComponentType::SECURITY;
    }

    abstract public function content(): SecurityScheme;
}
