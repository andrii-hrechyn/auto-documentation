<?php

namespace AutoDocumentation;

use AutoDocumentation\Traits\HasExample;
use AutoDocumentation\Traits\HasExamples;
use AutoDocumentation\Traits\HasName;
use AutoDocumentation\Traits\HasSchema;

class Content
{
    use HasName;
    use HasExample;
    use HasExamples;
    use HasSchema;

    public function __construct(string $contentType)
    {
        $this->name($contentType);
    }

    public static function make(string $contentType): static
    {
        return new static($contentType);
    }
}
