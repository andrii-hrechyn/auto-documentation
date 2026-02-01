<?php

namespace AutoDocumentation\Security\Schemas;

use AutoDocumentation\Enums\SecuritySchemeType;

class HttpSecurityScheme extends SecurityScheme
{
    protected string $scheme;
    protected string $bearerFormat = 'bearer';

    public static function make(string $scheme): static
    {
        return new static($scheme);
    }

    public function __construct(string $scheme)
    {
        $this->type = SecuritySchemeType::HTTP;
        $this->scheme = $scheme;
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

    public function toArray(): array
    {
        return [
            ...parent::toArray(),
            'scheme'       => $this->scheme,
            'bearerFormat' => $this->bearerFormat,
        ];
    }
}
