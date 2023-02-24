<?php

namespace AutoDocumentation\Traits;

use AutoDocumentation\Properties\BooleanProperty;
use AutoDocumentation\Properties\IntegerProperty;
use AutoDocumentation\Properties\NumberProperty;
use AutoDocumentation\Properties\Property;
use AutoDocumentation\Properties\StringProperty;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Enum;

//todo refactor it
trait RulesToPropertiesTrait
{
    protected function parsePropertyBasedOnValidationRules(string $property, array $rules): Property
    {
        $property = match (true) {
            in_array('integer', $rules) => $this->processNumber($property, $rules, true),
            in_array('numeric', $rules) => $this->processNumber($property, $rules),
            in_array('boolean', $rules) => BooleanProperty::make($property),
            //todo add Array processing
//            in_array('array', $rules)   => Property::make($property, Type::array),
            default                     => $this->processString($property, $rules),
        };

        if (in_array('required', $rules)) {
            $property->required();
        }

        return $property;
    }

    private function processNumber(string $name, array $rules, bool $isInteger = false): Property
    {
        $property = $isInteger ? IntegerProperty::make($name) : NumberProperty::make($name);

        if (($index = $this->ruleStartWith('min', $rules)) !== false) {
            $property->minimum(Str::after($rules[$index], ':'));
        }

        if (($index = $this->ruleStartWith('max', $rules)) !== false) {
            $property->maximum(Str::after($rules[$index], ':'));
        }

        if (($index = $this->ruleStartWith('size', $rules)) !== false) {
            $property->minimum(Str::after($rules[$index], ':'));
            $property->maximum(Str::after($rules[$index], ':'));
        }

        return $property;
    }

    private function processString(string $name, array $rules): Property
    {
        $property = StringProperty::make($name);

        foreach ($rules as $rule) {
            if ($rule instanceof Enum) {
                $ruleClass = new \ReflectionClass($rule);
                $enum = $ruleClass->getProperty('type');
                $enum->setAccessible(true);
                $enum = $enum->getValue($rule);

                $property->enum($enum);
            }

            if (is_object($rule)) {
                continue;
            }

            if (Str::startsWith($rule, 'min')) {
                $property->minLength(Str::after($rule, ':'));

                continue;
            }

            if (Str::startsWith($rule, 'max')) {
                $property->maxLength(Str::after($rule, ':'));

                continue;
            }

            if (Str::startsWith($rule, 'size')) {
                $property->minLength(Str::after($rule, ':'));
                $property->maxLength(Str::after($rule, ':'));
            }
        }

        return $property;
    }

    private function ruleStartWith(string $needles, array $rules): int|bool
    {
        return collect($rules)->search(fn($value) => Str::startsWith($value, $needles));
    }
}