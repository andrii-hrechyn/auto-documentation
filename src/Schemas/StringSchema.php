<?php

namespace AutoDocumentation\Schemas;

use AutoDocumentation\Enums\Type;

class StringSchema extends PrimitiveSchema
{
    protected ?int $maxLength = null;
    protected ?int $minLength = null;

    protected function getType(): Type
    {
        return Type::string;
    }

    public function maxLength(int $maxLength): static
    {
        $this->maxLength = $maxLength;

        return $this;
    }

    public function minLength(int $minLength): static
    {
        $this->minLength = $minLength;

        return $this;
    }

    protected function additionalFields(): array
    {
        return [
            'minLength' => $this->minLength,
            'maxLength' => $this->maxLength,
        ];
    }
}