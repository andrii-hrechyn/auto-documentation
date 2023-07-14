<?php

use AutoDocumentation\Contact;

it('can convert Contact with all properties to an array', function () {
    $name = 'John Doe';
    $email = 'johndoe@example.com';
    $url = 'https://example.com';

    $contact = new Contact($name, $email, $url);

    $expectedArray = [
        'name'  => $name,
        'email' => $email,
        'url'   => $url,
    ];

    expect($contact->toArray())->toBe($expectedArray);
});

it('can convert Contact with empty properties to an array', function () {
    $contact = new Contact();

    $expectedArray = [
        'name'  => '',
        'email' => '',
        'url'   => '',
    ];

    expect($contact->toArray())->toBe($expectedArray);
});