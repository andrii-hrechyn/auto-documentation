<?php

namespace AutoDocumentation\Schemas;

use AutoDocumentation\Enums\Type;

class IntegerSchema extends PrimitiveSchema
{
    protected ?int $maximum = null;
    protected ?int $minimum = null;

    protected function getType(): Type
    {
        return Type::integer;
    }

    public function maximum(int $maximum): static
    {
        $this->maximum = $maximum;

        return $this;
    }

    public function minimum(int $minimum): static
    {
        $this->minimum = $minimum;

        return $this;
    }

    protected function additionalFields(): array
    {
        return [
            'minimum' => $this->minimum,
            'maximum' => $this->maximum,
        ];
    }
}