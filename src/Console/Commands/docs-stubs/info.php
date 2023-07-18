<?php

use AutoDocumentation\Info;
use AutoDocumentation\OpenApi;
use AutoDocumentation\SecuritySchemes\SanctumAuth;
use AutoDocumentation\Server;

Info::make(env('APP_NAME'), '1.0.0')
    ->description('Your application description');

OpenApi::defaultSecurityScheme(SanctumAuth::make());

Server::make('http://localhost/api', 'Local server');


