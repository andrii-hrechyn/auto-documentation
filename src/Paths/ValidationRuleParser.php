<?php

namespace AutoDocumentation\Paths;

use AutoDocumentation\Properties\ArrayProperty;
use AutoDocumentation\Properties\ObjectProperty;
use AutoDocumentation\Schemas\ObjectSchema;
use AutoDocumentation\Schemas\StringSchema;
use AutoDocumentation\Traits\RulesToPropertyTrait;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ValidationRuleParser
{
    use RulesToPropertyTrait;

    public function parse(array $validationRules)
    {
        $validationRules = collect($validationRules);

        [$arrays, $primitives] = $validationRules
            ->map(fn(string|array $rules) => $this->normalizeRules($rules))
            ->partition(fn(array $rules, string $property) => Str::contains($property, '.') || in_array('array',
                    $rules));

        $schema = new ObjectSchema();

        $properties = $this->parsePrimitives($primitives);
        $schema->merge($properties->toArray());

        $properties = $this->parseArrays($arrays);
        $schema->merge($properties->toArray());

        return $schema;
    }

    private function parsePrimitives(Collection $validationRules): Collection
    {
        return $validationRules->map(
            fn(array $rules, string $property) => $this->parsePropertyBasedOnValidationRules($property, $rules)
        );
    }

    private function parseArrays(Collection $validationRules): Collection
    {
        return $validationRules
            ->groupBy(fn(array $rules, string $property) => Str::before($property, '.'), true)
            ->map(function (Collection $arrays, string $property) {
                ArrayProperty::make($property, new StringSchema());

                $arrayRules = $arrays->pull($property, []);

                if ($arrays->has($property.'.*')) {
                    $schema = $this->parseSchemaBasedOnValidationRules($arrays->get($property.'.*'));

                    return $this->parseArrayPropertyBasedOnValidationRules($property, $arrayRules, $schema);
                }

                if ($arrays->first(fn($v, $k) => Str::contains($k, '.*.'))) {
                    $nestedRules = $arrays->mapWithKeys(function (array $rules, string $property) {
                        return [Str::after($property, '*.') => $rules];
                    });

                    $schema = $this->parse($nestedRules->toArray());

                    return $this->parseArrayPropertyBasedOnValidationRules($property, $arrayRules, $schema);
                }

                $nestedRules = $arrays->mapWithKeys(function (array $rules, string $property) {
                    return [Str::after($property, '.') => $rules];
                });

                $schema = $this->parse($nestedRules->toArray());

                return ObjectProperty::make($property, $schema);
            });
    }

    private function normalizeRules(array|string $rules): array
    {
        return is_string($rules) ? explode('|', $rules) : $rules;
    }
}