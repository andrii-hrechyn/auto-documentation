<?php

namespace AutoDocumentation;

use AutoDocumentation\Traits\HasDescription;
use AutoDocumentation\Traits\HasExtensions;
use AutoDocumentation\Traits\HasTitle;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;

class Info implements Arrayable
{
    use HasTitle;
    use HasDescription;
    use HasExtensions;

    protected string $version;

    protected ?string $termsOfService = null;

    protected ?Contact $contact = null;

    protected ?License $license = null;

    public function __construct(string $title, string $version)
    {
        $this->title($title)
            ->version($version);
    }

    public static function make(string $title, string $version): static
    {
        return new static($title, $version);
    }

    public function version(string $version): static
    {
        $this->version = $version;

        return $this;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function termsOfService(string $termsOfService): static
    {
        if (!Str::isUrl($termsOfService)) {
            //todo throw exception
        }

        $this->termsOfService = $termsOfService;

        return $this;
    }

    public function getTermsOfService(): ?string
    {
        return $this->termsOfService;
    }

    public function contact(Contact $contact): static
    {
        $this->contact = $contact;

        return $this;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function license(License $license): static
    {
        $this->license = $license;

        return $this;
    }

    public function getLicense(): ?License
    {
        return $this->license;
    }

    public function toArray(): array
    {
        return array_filter([
            'title'          => $this->getTitle(),
            'description'    => $this->getDescription(),
            'termsOfService' => $this->getTermsOfService(),
            'contact'        => $this->getContact()?->toArray(),
            'license'        => $this->getLicense()?->toArray(),
            'version'        => $this->getVersion(),
            ...$this->getExtensions(),
        ], fn ($value) => $value !== null);
    }
}
