<?php

return [
    'generate_always' => env('AUTO_DOCUMENTATION_GENERATE_ALWAYS', false),

    'routes' => [
        'documentation' => 'api/doc',
        'specification' => 'api/doc/spec',
    ],

    'paths' => [
        'source' => base_path(env('AUTO_DOCUMENTATION_SOURCE', 'docs')),
        'generated-doc' => storage_path('auto-docs')
    ]
];
