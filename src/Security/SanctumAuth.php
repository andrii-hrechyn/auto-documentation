<?php

namespace AutoDocumentation\Security;

use AutoDocumentation\Security\Schemas\HttpSecurityScheme;
use AutoDocumentation\Security\Schemas\SecurityScheme;

class SanctumAuth extends SecurityRequirement
{
    public function content(): SecurityScheme
    {
        return HttpSecurityScheme::make('bearer')
            ->bearerFormat('sanctum')
            ->description(
                'Protected routes must have a required header: <br>
                                     `Authorization: Bearer {Auth token}`'
            );
    }
}
