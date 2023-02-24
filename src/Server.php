<?php

namespace AutoDocumentation;

class Server
{
    public static function make(string $server, string $description = ''): self
    {
        return OpenApi::instance()->registerServer(new self($server, $description));
    }

    private function __construct(
        protected readonly string $server,
        protected readonly string $description = ''
    ) {
    }

    public function toArray(): array
    {
        return [
            'url'         => $this->server,
            'description' => $this->description,
        ];
    }
}