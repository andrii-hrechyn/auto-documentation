<?php

namespace AutoDocumentation\Components;

use AutoDocumentation\Enums\ComponentType;
use AutoDocumentation\Schemas\ObjectSchema;

abstract class SchemaComponent extends Component
{
    public function type(): ComponentType
    {
        return ComponentType::schemas;
    }

    abstract public function content(): ObjectSchema;
}