<?php

namespace AutoDocumentation;

use AutoDocumentation\Contracts\Resolvable;
use AutoDocumentation\Schemas\Schema;

class Reference extends Schema implements Resolvable
{
    public function __construct(
        protected readonly string $ref
    ) {
    }

    public static function make(string $ref): self
    {
        return new self($ref);
    }

    public function resolve(): array
    {
        return [
            '$ref' => $this->ref,
        ];
    }
}