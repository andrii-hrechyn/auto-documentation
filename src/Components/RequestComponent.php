<?php

namespace AutoDocumentation\Components;

use AutoDocumentation\Enums\ComponentType;
use AutoDocumentation\Requests\Request;

abstract class RequestComponent extends SimpleComponent
{
    public function type(): ComponentType
    {
        return ComponentType::REQUEST;
    }

    protected function request(): Request
    {
        return Request::make();
    }

    abstract public function content(): Request;
}
