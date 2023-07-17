<?php

namespace AutoDocumentation;

class Server
{
    protected array $variables = [];

    public static function make(string $server, string $description = ''): self
    {
        return OpenApi::instance()->server(new self($server, $description));
    }

    private function __construct(
        protected readonly string $server,
        protected readonly string $description = ''
    ) {
    }

    public function variables(array $variables): self
    {
        $this->variables = $variables;

        return $this;
    }

    public function variable(string $name, string $default, array $enum = [], string $description = ''): self
    {
        $this->variables[$name] = [
            'default'     => $default,
            'enum'        => $enum,
            'description' => $description,
        ];

        return $this;
    }

    public function toArray(): array
    {
        return [
            'url'         => $this->server,
            'description' => $this->description,
            'variables'   => $this->variables,
        ];
    }
}