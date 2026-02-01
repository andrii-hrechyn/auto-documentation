<?php

namespace AutoDocumentation\Components;

use AutoDocumentation\Enums\ComponentType;
use AutoDocumentation\Responses\Response;

abstract class ResponseComponent extends SimpleComponent
{
    public function type(): ComponentType
    {
        return ComponentType::RESPONSE;
    }

    public function getName(): string
    {
        return $this->content()->getName();
    }

    protected function response(string $statusCode): Response
    {
        return Response::make($statusCode);
    }

    abstract public function content(): Response;
}
