<?php

namespace AutoDocumentation\Traits;

use AutoDocumentation\Schemas\BooleanSchema;
use AutoDocumentation\Schemas\IntegerSchema;
use AutoDocumentation\Schemas\NumberSchema;
use AutoDocumentation\Schemas\Schema;
use AutoDocumentation\Schemas\StringSchema;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Enum;

//todo refactor it
trait RulesToSchemaTrait
{
    protected function parseSchemaBasedOnValidationRules(array $rules): Schema
    {
        $schema = match (true) {
            in_array('integer', $rules) => $this->processNumber($rules, true),
            in_array('numeric', $rules) => $this->processNumber($rules),
            in_array('boolean', $rules) => BooleanSchema::make(),
            default                     => $this->processString($rules),
        };

        return $schema;
    }

    private function processNumber(array $rules, bool $isInteger = false): Schema
    {
        $schema = $isInteger ? IntegerSchema::make() : NumberSchema::make();

        if (($index = $this->ruleStartWith('min', $rules)) !== false) {
            $schema->minimum(Str::after($rules[$index], ':'));
        }

        if (($index = $this->ruleStartWith('max', $rules)) !== false) {
            $schema->maximum(Str::after($rules[$index], ':'));
        }

        if (($index = $this->ruleStartWith('size', $rules)) !== false) {
            $schema->minimum(Str::after($rules[$index], ':'));
            $schema->maximum(Str::after($rules[$index], ':'));
        }

        return $schema;
    }

    private function processString(array $rules): Schema
    {
        $schema = StringSchema::make();

        foreach ($rules as $rule) {
            if ($rule instanceof Enum) {
                $ruleClass = new \ReflectionClass($rule);
                $enum = $ruleClass->getProperty('type');
                $enum->setAccessible(true);
                $enum = $enum->getValue($rule);

                $schema->enum($enum);
            }

            if (is_object($rule)) {
                continue;
            }

            if (Str::startsWith($rule, 'min')) {
                $schema->minLength(Str::after($rule, ':'));

                continue;
            }

            if (Str::startsWith($rule, 'max')) {
                $schema->maxLength(Str::after($rule, ':'));

                continue;
            }

            if (Str::startsWith($rule, 'size')) {
                $schema->minLength(Str::after($rule, ':'));
                $schema->maxLength(Str::after($rule, ':'));
            }
        }

        return $schema;
    }

    private function ruleStartWith(string $needles, array $rules): int|bool
    {
        return collect($rules)->search(fn($value) => Str::startsWith($value, $needles));
    }
}