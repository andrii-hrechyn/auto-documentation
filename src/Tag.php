<?php

namespace AutoDocumentation;

use AutoDocumentation\Traits\HasDescription;
use AutoDocumentation\Traits\HasExtensions;
use AutoDocumentation\Traits\HasExternalDocs;
use AutoDocumentation\Traits\HasName;
use Illuminate\Contracts\Support\Arrayable;

class Tag implements Arrayable
{
    use HasName;
    use HasDescription;
    use HasExternalDocs;
    use HasExtensions;

    public function toArray(): array
    {
        return array_filter([
            'name'         => $this->getName(),
            'description'  => $this->getDescription(),
            'externalDocs' => $this->getExternalDocs()?->toArray(),
            ...$this->getExtensions(),
        ], fn ($value) => $value !== null);
    }
}
