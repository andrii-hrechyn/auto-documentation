<?php

namespace AutoDocumentation;

use AutoDocumentation\Traits\HasDescription;
use AutoDocumentation\Traits\HasExternalDocs;
use AutoDocumentation\Traits\HasName;
use Illuminate\Contracts\Support\Arrayable;

class Tag implements Arrayable
{
    use HasName;
    use HasDescription;
    use HasExternalDocs;

    public function toArray(): array
    {
        return [
            'name'         => $this->getName(),
            'description'  => $this->getDescription(),
            'externalDocs' => $this->getExternalDocs(),
        ];
    }
}
