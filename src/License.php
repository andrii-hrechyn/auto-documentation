<?php

namespace AutoDocumentation;

use AutoDocumentation\Traits\HasName;
use AutoDocumentation\Traits\HasUrl;

class License
{
    use HasName;
    use HasUrl;

    public function __construct(string $name)
    {
        $this->name($name);
    }

    public static function make(string $name): static
    {
        return new static($name);
    }
}
