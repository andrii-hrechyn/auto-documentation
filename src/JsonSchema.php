<?php

namespace AutoDocumentation;

use AutoDocumentation\Enums\Format;
use AutoDocumentation\Enums\Type;
use AutoDocumentation\Traits\HasDescription;
use AutoDocumentation\Traits\HasEnum;
use AutoDocumentation\Traits\HasTitle;

//todo add default
class JsonSchema
{
    use HasTitle;
    use HasDescription;
    use HasEnum;

    protected ?Type $type = null;

    protected Format|string|null $format = null;

    public function type(Type $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getType(): Type
    {
        return $this->type;
    }

    public function format(Format|string $format): static
    {
        $this->format = $format;

        return $this;
    }

    public function getFormat(): Format|string|null
    {
        return $this->format;
    }
}
