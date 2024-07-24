<?php

namespace AutoDocumentation\Schemas;

use AutoDocumentation\Enums\Type;

class StringSchema extends PrimitiveSchema
{
    protected ?int $maxLength = null;
    protected ?int $minLength = null;

    public function __construct()
    {
        $this->type = Type::STRING;
    }

    public function maxLength(int $maxLength): static
    {
        $this->maxLength = $maxLength;

        return $this;
    }

    public function getMaxLength(): ?int
    {
        return $this->maxLength;
    }

    public function minLength(int $minLength): static
    {
        $this->minLength = $minLength;

        return $this;
    }

    public function getMinLength(): ?int
    {
        return $this->minLength;
    }
}
