<?php

namespace AutoDocumentation\Paths;

use AutoDocumentation\Exceptions\RouteNotFoundException;
use AutoDocumentation\OpenApi;
use AutoDocumentation\Traits\RulesToPropertyTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Route as LaravelRoute;
use Illuminate\Support\Facades\Route as RouteFacade;
use Illuminate\Support\Str;
use ReflectionMethod;

class Route extends BasePath
{
    use RulesToPropertyTrait;

    protected LaravelRoute $route;

    public function __construct(string $method, string $path, string $summary, LaravelRoute $route)
    {
        parent::__construct($method, $path, $summary);

        $this->route = $route;
    }

    public static function make(string $name, string $summary): static
    {
        /** @var LaravelRoute $route */
        $route = RouteFacade::getRoutes()->getByName($name);

        if (!$route) {
            throw new RouteNotFoundException($name);
        }

        return OpenApi::instance()->registryPath(
            new static(Str::lower($route->methods[0]), '/'.ltrim($route->uri, '/'), $summary, $route)
        );
    }

    public function requestBodyFromRequestClass(): static
    {
        $requestClass = $this->requestClassFromRoute($this->route);

        if (!$requestClass) {
            return $this;
        }

        $validationRules = app()->call([new $requestClass(), 'rules']);

        $parser = new ValidationRuleParser();

        $schema = $parser->parse($validationRules);

        $this->jsonRequest($schema);

        return $this;
    }

    private function requestClassFromRoute(LaravelRoute $route)
    {
        $r = new ReflectionMethod($this->route->getControllerClass(), $this->route->getActionMethod());

        $params = $r->getParameters();
        foreach ($params as $param) {
            $paramName = $param->getType()->getName();

            if (!class_exists($paramName) || !is_subclass_of($paramName, Request::class)) {
                continue;
            }

            $requestClass = new \ReflectionClass($paramName);

            if ($requestClass->hasMethod('rules')) {
                return $paramName;
            }
        }
    }
}