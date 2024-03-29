<?php

namespace AutoDocumentation\SecuritySchemes;

use AutoDocumentation\Contracts\Resolvable;

class SecurityScheme implements Resolvable
{
    protected string $scheme = '';
    protected string $bearerFormat = '';
    protected string $description = '';

    public static function make(string $name, string $type, string $in): self
    {
        return new self($name, $type, $in);
    }

    private function __construct(
        public readonly string $name,
        public readonly string $type,
        public readonly string $in
    ) {
    }

    public function scheme(string $scheme): self
    {
        $this->scheme = $scheme;

        return $this;
    }

    public function bearerFormat(string $bearerFormat): self
    {
        $this->bearerFormat = $bearerFormat;

        return $this;
    }

    public function description(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function resolve(): array
    {
        return [
            'type'         => $this->type,
            'description'  => $this->description,
            'in'           => $this->in,
            'scheme'       => $this->scheme,
            'bearerFormat' => $this->bearerFormat,
        ];
    }
}