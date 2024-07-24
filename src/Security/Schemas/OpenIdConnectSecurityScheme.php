<?php

namespace AutoDocumentation\Security\Schemas;

use AutoDocumentation\Enums\SecuritySchemeType;

class OpenIdConnectSecurityScheme extends SecurityScheme
{
    protected string $openIdConnectUrl;

    public static function make(string $openIdConnectUrl): static
    {
        return new static($openIdConnectUrl);
    }

    public function __construct(string $openIdConnectUrl)
    {
        $this->type = SecuritySchemeType::OPEN_ID_CONNECT;
        $this->openIdConnectUrl = $openIdConnectUrl;
    }

    public function toArray(): array
    {
        return [
            ...parent::toArray(),
            'openIdConnectUrl' => $this->openIdConnectUrl,
        ];
    }
}
