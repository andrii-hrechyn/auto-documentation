<?php

namespace AutoDocumentation\Schemas;

use AutoDocumentation\Enums\Type;
use AutoDocumentation\Traits\HasDeprecated;
use AutoDocumentation\Traits\HasDescription;
use AutoDocumentation\Traits\HasEnum;
use AutoDocumentation\Traits\HasExample;
use AutoDocumentation\Traits\HasExamples;
use AutoDocumentation\Traits\HasExternalDocs;
use AutoDocumentation\Traits\HasFormat;
use AutoDocumentation\Traits\HasTitle;

abstract class Schema
{
    use HasTitle;
    use HasDescription;
    use HasDeprecated;
    use HasExternalDocs;
    use HasFormat;
    use HasEnum;
    use HasExample;
    use HasExamples;

    protected Type $type;
    protected ?string $format = null;
    protected mixed $default = null;

    protected bool $nullable = false;

    public function default($default): static
    {
        $this->default = $default;

        return $this;
    }

    public function getType(): Type
    {
        return $this->type;
    }
}
