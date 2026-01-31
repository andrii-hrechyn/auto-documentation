<?php

namespace AutoDocumentation\Content;

use AutoDocumentation\Traits\HasExample;
use AutoDocumentation\Traits\HasExamples;
use AutoDocumentation\Traits\HasName;
use AutoDocumentation\Traits\HasSchema;
use Illuminate\Contracts\Support\Arrayable;

class Content implements Arrayable
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

    public function toArray(): array
    {
        return [
            'schema' => $this->getSchema()->toArray(),
        ];
    }
}
