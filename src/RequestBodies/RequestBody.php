<?php

namespace AutoDocumentation\RequestBodies;

class RequestBody
{
    protected Content $content;
    protected bool $required;
    protected string $description = '';

    public function __construct(Content $content, $required = true)
    {
        $this->content = $content;
        $this->required = $required;
    }

    public function description(string $description): static
    {
        $this->description = $description;

        return $this;
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