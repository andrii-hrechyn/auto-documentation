<?php

namespace AutoDocumentation\Exceptions;

class RouteNotFoundException extends AutoDocumentationException
{
    public function __construct(string $routeName)
    {
        parent::__construct("Route with name [$routeName] not found");
    }
}