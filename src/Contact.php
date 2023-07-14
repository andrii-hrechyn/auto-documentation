<?php

namespace AutoDocumentation;

class Contact
{
    public function __construct(
        protected readonly string $name,
        protected readonly string $email,
        protected readonly string $url
    ) {
    }

    public function toArray(): array
    {
        return [
            'name'  => $this->name,
            'email' => $this->email,
            'url'   => $this->url,
        ];
    }
}