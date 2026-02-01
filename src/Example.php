<?php

namespace AutoDocumentation;

use AutoDocumentation\Traits\HasDescription;
use AutoDocumentation\Traits\HasExtensions;
use AutoDocumentation\Traits\HasName;
use AutoDocumentation\Traits\HasSummary;

class Example
{
    use HasName;
    use HasDescription;
    use HasSummary;
    use HasExtensions;

    protected mixed $value = null;

    public function value(mixed $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }
}
