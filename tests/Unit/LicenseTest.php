<?php

use AutoDocumentation\License;

it('can convert License to an array', function () {
    $name = 'MIT';
    $url = 'https://opensource.org/licenses/MIT';

    $license = new License($name, $url);

    $expectedArray = [
        'name' => $name,
        'url'  => $url,
    ];

    expect($license->toArray())->toBe($expectedArray);
});

it('can convert License without URL to an array', function () {
    $name = 'GPL';

    $license = new License($name);

    $expectedArray = [
        'name' => $name,
        'url'  => null,
    ];

    expect($license->toArray())->toBe($expectedArray);
});