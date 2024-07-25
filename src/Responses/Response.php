<?php

namespace AutoDocumentation\Responses;

use AutoDocumentation\Traits\HasContent;
use AutoDocumentation\Traits\HasDescription;
use AutoDocumentation\Traits\HasName;
use Illuminate\Contracts\Support\Arrayable;

class Response implements Arrayable
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

    public function toArray(): array
    {
        return [
            'description' => $this->getDescription(),
            'content'     => $this->getContent()->toArray(),
        ];
    }
}
