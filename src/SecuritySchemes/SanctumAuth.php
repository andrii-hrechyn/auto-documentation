<?php

namespace AutoDocumentation\SecuritySchemes;

use AutoDocumentation\Components\SecuritySchemeComponent;

class SanctumAuth extends SecuritySchemeComponent
{
    public function content(): SecurityScheme
    {
        return SecurityScheme::make('SanctumAuth', 'http', 'header')
            ->scheme('bearer')
            ->bearerFormat('sanctum')
            ->description('Protected routes must have a required header: <br>
                                     `Authorization: Bearer {Auth token}`');
    }
}