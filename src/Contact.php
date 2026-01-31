<?php

namespace AutoDocumentation;

use AutoDocumentation\Traits\HasExtensions;
use AutoDocumentation\Traits\HasName;
use AutoDocumentation\Traits\HasUrl;

class Contact
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
}
