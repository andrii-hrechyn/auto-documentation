<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Documentation generation
    |--------------------------------------------------------------------------
    |
    | If this parameter is set to "true" - Always when you will open/reload page
    | with documentation it will be regenerated.
    | It might be useful for local development when you need to track your
    | changes in live.
    | ! It might have impact to performance, use it only for local development !
    |
    | If this parameter is set to "false" - Documentation will be generated only
    | after running the command.
    | It is a default behavior when you generate documentation by running command.
    |
    */

    'generate_always' => env('AUTO_DOCUMENTATION_GENERATE_ALWAYS', false),

    /*
    |--------------------------------------------------------------------------
    | Documentation environments
    |--------------------------------------------------------------------------
    |
    | Environments on which the documentation will be available.
    |
    */

    'environment' => ['local', 'development'],

    /*
    |--------------------------------------------------------------------------
    | Documentation routes
    |--------------------------------------------------------------------------
    |
    | In this section you can change the routes on which documentation
    | will be available.
    |
    */

    'routes' => [
        'documentation' => 'api/doc',
        'specification' => 'api/doc/spec',
    ],

    /*
    |--------------------------------------------------------------------------
    | Documentation routes
    |--------------------------------------------------------------------------
    |
    | In this section you can change the paths to documentation sources
    | and auto generated yaml file
    |
    */

    'paths' => [
        'source' => base_path(env('AUTO_DOCUMENTATION_SOURCE', 'docs')),
        'generated-doc' => storage_path('app/auto-docs')
    ]
];
