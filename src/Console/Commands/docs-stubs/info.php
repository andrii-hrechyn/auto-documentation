<?php

use AutoDocumentation\Contact;
use AutoDocumentation\ExternalDocs;
use AutoDocumentation\Info;
use AutoDocumentation\License;
use AutoDocumentation\OpenApi;
use AutoDocumentation\SecuritySchemes\SanctumAuth;
use AutoDocumentation\Server;

Info::make(env('APP_NAME'), '1.0.0')
    ->contact(new Contact('My new contract', 'new@gmail.com', 'https://openapi.com'))
    ->license(new License('My new licence', 'https://openapi.com'))
    ->description('Your application description');

OpenApi::defaultSecurityScheme(SanctumAuth::make());
//OpenApi::security(SanctumAuth::make());

Server::make('http://localhost.com/api', 'Local server');
Server::make('http://sandbox.com/api', 'Sandbox server');

ExternalDocs::make('http://localhost.com/api', 'Example of external doc');


