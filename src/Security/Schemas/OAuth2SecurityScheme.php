<?php

namespace AutoDocumentation\Security\Schemas;

use AutoDocumentation\Enums\SecuritySchemeType;

class OAuth2SecurityScheme extends SecurityScheme
{
    // todo implement https://github.com/OAI/OpenAPI-Specification/blob/main/versions/3.0.1.md#oauth-flows-object
    protected array $flows;

    public static function make(): static
    {
        return new static();
    }

    public function __construct()
    {
        $this->type = SecuritySchemeType::OAUTH2;
    }

    public function toArray(): array
    {
        return [
            ...parent::toArray(),
            'flows' => [],
        ];
    }
}
