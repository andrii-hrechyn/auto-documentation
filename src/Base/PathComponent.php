<?php

namespace AutoDocumentation\Base;

use AutoDocumentation\Exceptions\RouteNotFoundException;
use AutoDocumentation\Paths\Method;
use AutoDocumentation\Paths\Path;
use Illuminate\Routing\Route as LaravelRoute;
use Illuminate\Support\Facades\Route as RouteFacade;

abstract class PathComponent
{
    abstract public function path(): Path;

    protected function route(string $name): Path
    {
        /** @var LaravelRoute $route */
        $route = RouteFacade::getRoutes()->getByName($name);

        if (!$route) {
            throw new RouteNotFoundException($name);
        }

        return $this->make($route->uri());
    }

    protected function make(string $path): Path
    {
        return Path::make($path);
    }

    protected function method(string $method): Method
    {
        return Method::make($method);
    }

    public function methods(): array
    {
        $availableMethods = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'];

        foreach ($availableMethods as $method) {
            if (!method_exists($this, mb_strtolower($method))) {
                continue;
            }

            $methods[] = $this->$method($this->method($method));
        }

        return $methods ?? [];
    }
}
