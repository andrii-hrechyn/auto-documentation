<?php

namespace AutoDocumentation\Responses;

use AutoDocumentation\Traits\HasContent;
use AutoDocumentation\Traits\HasDescription;
use AutoDocumentation\Traits\HasName;

class Response
{
    use HasName;
    use HasDescription;
    use HasContent;

    public function __construct(int $statusCode)
    {
        $this->name($statusCode);
    }

    public static function make(int $statusCode): static
    {
        return new static($statusCode);
    }
}
