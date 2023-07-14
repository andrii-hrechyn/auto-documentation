<?php

use AutoDocumentation\Contact;
use AutoDocumentation\Info;
use AutoDocumentation\License;

it('can create an Info instance with make()', function () {
    $title = 'API Title';
    $version = '1.0.0';

    $info = Info::make($title, $version);

    expect($info)->toBeInstanceOf(Info::class)
        ->and($info->toArray())->toEqual([
            'title'          => $title,
            'description'    => '',
            'termsOfService' => null,
            'contact'        => null,
            'license'        => null,
            'version'        => $version,
        ]);
});

it('can set the description', function () {
    $title = 'API Title';
    $version = '1.0.0';
    $description = 'API Description';

    $info = Info::make($title, $version)
        ->description($description);

    expect($info->toArray()['description'])->toBe($description);
});

it('can set the terms of service', function () {
    $title = 'API Title';
    $version = '1.0.0';
    $termsOfService = 'https://example.com/terms';

    $info = Info::make($title, $version)
        ->termsOfService($termsOfService);

    expect($info->toArray()['termsOfService'])->toBe($termsOfService);
});

it('can set the contact', function () {
    $title = 'API Title';
    $version = '1.0.0';

    $contactName = 'John Doe';
    $contactEmail = 'johndoe@example.com';
    $contactUrl = 'https://example.com/contact';
    $contact = new Contact($contactName, $contactEmail, $contactUrl);

    $info = Info::make($title, $version)
        ->contact($contact);

    expect($info->toArray()['contact'])->toBe($contact->toArray());
});

it('can set the license', function () {
    $title = 'API Title';
    $version = '1.0.0';

    $licenseName = 'MIT';
    $licenseUrl = 'https://opensource.org/licenses/MIT';
    $license = new License($licenseName, $licenseUrl);

    $info = Info::make($title, $version)
        ->license($license);

    expect($info->toArray()['license'])->toBe($license->toArray());
});

it('can convert Info to an array', function () {
    $title = 'API Title';
    $version = '1.0.0';
    $description = 'API Description';
    $termsOfService = 'https://example.com/terms';

    $contactName = 'John Doe';
    $contactEmail = 'johndoe@example.com';
    $contactUrl = 'https://example.com/contact';
    $contact = new Contact($contactName, $contactEmail, $contactUrl);

    $licenseName = 'MIT';
    $licenseUrl = 'https://opensource.org/licenses/MIT';
    $license = new License($licenseName, $licenseUrl);

    $info = Info::make($title, $version)
        ->description($description)
        ->termsOfService($termsOfService)
        ->contact($contact)
        ->license($license);

    $expectedArray = [
        'title'          => $title,
        'description'    => $description,
        'termsOfService' => $termsOfService,
        'contact'        => $contact->toArray(),
        'license'        => $license->toArray(),
        'version'        => $version,
    ];

    expect($info->toArray())->toBe($expectedArray);
});
