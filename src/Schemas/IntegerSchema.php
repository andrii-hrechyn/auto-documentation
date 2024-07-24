<?php

namespace AutoDocumentation\Schemas;

use AutoDocumentation\Enums\Type;

class IntegerSchema extends PrimitiveSchema
{
    protected ?int $maximum = null;
    protected ?int $minimum = null;

    public function __construct()
    {
        $this->type = Type::INTEGER;
    }

    public function maximum(int $maximum): static
    {
        $this->maximum = $maximum;

        return $this;
    }

    public function getMaximum(): ?int
    {
        return $this->maximum;
    }

    public function minimum(int $minimum): static
    {
        $this->minimum = $minimum;

        return $this;
    }

    public function getMinimum(): ?int
    {
        return $this->minimum;
    }
}
