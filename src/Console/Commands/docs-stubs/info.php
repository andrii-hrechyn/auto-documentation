<?php

use AutoDocumentation\Info;
use AutoDocumentation\SecuritySchemes\SecurityScheme;
use AutoDocumentation\Server;

Info::make(env('APP_NAME'), '1.0.0')
    ->description('Your application description');

SecurityScheme::make('SanctumAuth', 'http', 'header')
    ->scheme('bearer')
    ->bearerFormat('sanctum')
    ->description('Protected routes must have a required header: <br>
    `Authorization: Bearer {Auth token}`');

Server::make('http://localhost.com/api', 'Local server');



