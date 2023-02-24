<?php

namespace AutoDocumentation\Components;

use AutoDocumentation\Container;
use AutoDocumentation\Enums\ComponentType;
use AutoDocumentation\Responses\Response;

abstract class ResponseComponent extends Component
{
    public function type(): ComponentType
    {
        return ComponentType::responses;
    }

    public function name(): string
    {
        return $this->content()->statusCode;
    }

    public function resolve(): array
    {
        Container::$components[$this->type()->name] += $this->content()->resolve();

        return [$this->content()->statusCode => $this->reference()->resolve()];
    }

    abstract public function content(): Response;
}