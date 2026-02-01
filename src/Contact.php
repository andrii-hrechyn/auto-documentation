<?php

namespace AutoDocumentation;

use AutoDocumentation\Traits\HasExtensions;
use AutoDocumentation\Traits\HasName;
use AutoDocumentation\Traits\HasUrl;
use Illuminate\Contracts\Support\Arrayable;

class Contact implements Arrayable
{
    use HasName;
    use HasUrl;
    use HasExtensions;

    protected string $email;

    public function email(string $email): static
    {
        //todo add email check

        $this->email = $email;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function toArray(): array
    {
        return array_filter([
            'name'  => $this->getName(),
            'url'   => $this->getUrl(),
            'email' => $this->getEmail(),
            ...$this->getExtensions(),
        ], fn ($value) => $value !== null);
    }
}
