<?php

namespace AutoDocumentation\Security\Schemas;

use AutoDocumentation\Enums\ApiKeySecuritySchemeIn;
use AutoDocumentation\Enums\SecuritySchemeType;
use AutoDocumentation\Traits\HasName;

class ApiKeySecurityScheme extends SecurityScheme
{
    use HasName;

    protected ApiKeySecuritySchemeIn $in;

    public static function make(string $name, ApiKeySecuritySchemeIn $in): static
    {
        return new static($name, $in);
    }

    public function __construct(string $name, ApiKeySecuritySchemeIn $in)
    {
        $this->type = SecuritySchemeType::API_KEY;
        $this->name($name);
        $this->in = $in;
    }

    public function toArray(): array
    {
        return [
            ...parent::toArray(),
            'name' => $this->getName(),
            'in'   => $this->in->value,
        ];
    }
}
