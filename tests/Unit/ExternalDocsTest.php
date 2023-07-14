<?php

use AutoDocumentation\ExternalDocs;

it('can create an ExternalDocs instance with make()', function () {
    $url = 'https://example.com/docs';
    $description = 'External documentation';

    $externalDocs = ExternalDocs::make($url, $description);

    expect($externalDocs)->toBeInstanceOf(ExternalDocs::class)
        ->and($externalDocs->toArray())->toEqual([
            'url'         => $url,
            'description' => $description,
        ]);
});

it('can create an ExternalDocs instance with make() using default description', function () {
    $url = 'https://example.com/docs';

    $externalDocs = ExternalDocs::make($url);

    expect($externalDocs->toArray())->toEqual([
        'url'         => $url,
        'description' => '',
    ]);
});





