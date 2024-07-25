<?php

namespace AutoDocumentation\Security\Schemas;

use AutoDocumentation\Enums\SecuritySchemeType;
use AutoDocumentation\Traits\HasDescription;
use AutoDocumentation\Traits\HasName;
use Illuminate\Contracts\Support\Arrayable;

abstract class SecurityScheme implements Arrayable
{
    use HasName;
    use HasDescription;

    protected SecuritySchemeType $type;

    public function toArray(): array
    {
        // todo add type field check !!!

        return [
            'type'        => $this->type->value,
            'description' => $this->description,
        ];
    }
}
