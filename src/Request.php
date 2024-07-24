<?php

namespace AutoDocumentation;

use AutoDocumentation\Traits\HasContent;
use AutoDocumentation\Traits\HasDescription;
use AutoDocumentation\Traits\HasRequired;

class Request
{
    use HasDescription;
    use HasRequired;
    use HasContent;

    public function __construct()
    {
    }

    public static function make(): static
    {
        return new static();
    }
}
