<?php

use AutoDocumentation\Server;

it('can create a Server instance with make()', function () {
    $server = 'https://api.example.com';
    $description = 'API server';

    $serverInstance = Server::make($server, $description);

    expect($serverInstance)->toBeInstanceOf(Server::class)
        ->and($serverInstance->toArray())->toEqual([
            'url'         => $server,
            'description' => $description,
            'variables'   => [],
        ]);
});

it('can set variables using variables()', function () {
    $server = 'https://api.example.com';
    $description = 'API server';
    $variables = [
        'var1' => [
            'default'     => 'value1',
            'enum'        => ['value1', 'value2'],
            'description' => 'Variable 1',
        ],
        'var2' => [
            'default'     => 'value3',
            'enum'        => ['value3', 'value4'],
            'description' => 'Variable 2',
        ],
    ];

    $serverInstance = Server::make($server, $description)
        ->variables($variables);

    expect($serverInstance->toArray())->toEqual([
        'url'         => $server,
        'description' => $description,
        'variables'   => $variables,
    ]);
});

it('can add a single variable using variable()', function () {
    $server = 'https://api.example.com';
    $description = 'API server';
    $variableName = 'var1';
    $variableDefault = 'value1';
    $variableEnum = ['value1', 'value2'];
    $variableDescription = 'Variable 1';
    $expectedVariables = [
        $variableName => [
            'default'     => $variableDefault,
            'enum'        => $variableEnum,
            'description' => $variableDescription,
        ],
    ];

    $serverInstance = Server::make($server, $description)
        ->variable($variableName, $variableDefault, $variableEnum, $variableDescription);

    expect($serverInstance->toArray())->toEqual([
        'url'         => $server,
        'description' => $description,
        'variables'   => $expectedVariables,
    ]);
});

it('can convert Server to an array', function () {
    $server = 'https://api.example.com';
    $description = 'API server';
    $variables = [
        'var1' => [
            'default'     => 'value1',
            'enum'        => ['value1', 'value2'],
            'description' => 'Variable 1',
        ],
        'var2' => [
            'default'     => 'value3',
            'enum'        => ['value3', 'value4'],
            'description' => 'Variable 2',
        ],
    ];

    $serverInstance = Server::make($server, $description)
        ->variables($variables);

    $expectedArray = [
        'url'         => $server,
        'description' => $description,
        'variables'   => $variables,
    ];

    expect($serverInstance->toArray())->toBe($expectedArray);
});




