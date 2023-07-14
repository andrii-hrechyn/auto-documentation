<?php

namespace AutoDocumentation;

class Info
{
    protected string $description = '';
    protected ?string $termsOfService = null;

    protected ?Contact $contact = null;
    protected ?License $license = null;

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

    public function termsOfService(string $url): self
    {
        $this->termsOfService = $url;

        return $this;
    }

    public function contact(Contact $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function license(License $license): self
    {
        $this->license = $license;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'title'          => $this->title,
            'description'    => $this->description,
            'termsOfService' => $this->termsOfService,
            'contact'        => $this->contact?->toArray(),
            'license'        => $this->license?->toArray(),
            'version'        => $this->version,
        ];
    }
}