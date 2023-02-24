<?php

namespace AutoDocumentation;

class Info
{
    protected string $description;

    public static function make(string $title, string $version): self
    {
        return OpenApi::instance()->registerInfo(new self($title, $version));
    }

    private function __construct(
        protected readonly string $title,
        protected readonly string $version
    ) {
    }

    public function description(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'title'       => $this->title,
            'description' => $this->description,
            'version'     => $this->version,
        ];
    }
}