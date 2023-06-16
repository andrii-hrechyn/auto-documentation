<?php

namespace AutoDocumentation\Traits;

use AutoDocumentation\Properties\ArrayProperty;
use AutoDocumentation\Properties\FileProperty;
use AutoDocumentation\Properties\Property;
use AutoDocumentation\Schemas\ArraySchema;
use AutoDocumentation\Schemas\Schema;
use Illuminate\Support\Str;

//todo refactor it
trait RulesToPropertyTrait
{
    use RulesToSchemaTrait;

    protected function parsePropertyBasedOnValidationRules(string $propertyName, array $rules): Property
    {
        $schema = $this->parseSchemaBasedOnValidationRules($rules);

        $property = new Property($propertyName, $schema);

        $property = match (true) {
            in_array('file', $rules) => FileProperty::make($propertyName),
            default                  => $property,
        };

        if (in_array('required', $rules)) {
            $property->required();
        }

        return $property;
    }

    protected function parseArrayPropertyBasedOnValidationRules(string $propertyName, array $rules, Schema $schema)
    {
        $arraySchema = ArraySchema::make($schema);

        if (($index = $this->ruleStartWith('min', $rules)) !== false) {
            $arraySchema->minItems(Str::after($rules[$index], ':'));
        }

        if (($index = $this->ruleStartWith('max', $rules)) !== false) {
            $arraySchema->maxItems(Str::after($rules[$index], ':'));
        }

        if (($index = $this->ruleStartWith('size', $rules)) !== false) {
            $arraySchema->minItems(Str::after($rules[$index], ':'));
            $arraySchema->maxItems(Str::after($rules[$index], ':'));
        }

        $property = new ArrayProperty($propertyName, $arraySchema);

        if (in_array('required', $rules)) {
            $property->required();
        }

        return $property;
    }
}