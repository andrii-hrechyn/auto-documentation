<?php

namespace AutoDocumentation\Traits;

use BackedEnum;
use UnitEnum;

trait HasEnum
{
    protected array $enum = [];

    public function enum(array|string $enum): static
    {
        if (is_string($enum) && enum_exists($enum)) {
            $enum = $this->processEnumClass($enum);
        }

        $this->enum = (array) $enum;

        return $this;
    }

    public function getEnum(): array
    {
        return $this->enum;
    }

    protected function processEnumClass(string $enumClass): array
    {
        /** @var UnitEnum $enumClass */
        foreach ($enumClass::cases() as $case) {
            $values[] = $this->getCaseValue($case);
        }

        return $values ?? [];
    }

    protected function getCaseValue(UnitEnum|BackedEnum $case): string
    {
        if ($case instanceof \BackedEnum) {
            return $case->value;
        }

        return $case->name;
    }
}
