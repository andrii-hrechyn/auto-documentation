<?php

namespace AutoDocumentation\RequestBodies;

use AutoDocumentation\Traits\CanBeRequired;
use AutoDocumentation\Traits\HasDescription;

class RequestBody
{
    use HasDescription;
    use CanBeRequired;

    protected Content $content;

    public function __construct(Content $content, $required = true)
    {
        $this->content = $content;
        $this->required = $required;
    }

    public function resolve(): array
    {
        return [
            'required'    => $this->required,
            'description' => $this->description,
            'content'     => $this->content->resolve(),
        ];
    }

    public static function make(Content $content, $required = true): static
    {
        return new static($content, $required);
    }
}