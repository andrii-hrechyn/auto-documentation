<?php

namespace AutoDocumentation;

class Normalizer
{
    protected array $ignoreEmptyValueFiltering = [
        'security',
    ];

    public function normalize(array $array): array
    {
        return $this->filterEmptyValue($array);
    }

    protected function filterEmptyValue(array $array): array
    {
        return collect($array)
            ->map(function ($value, string $key) {
                if (in_array($key, $this->ignoreEmptyValueFiltering)) {
                    return $value;
                }

                if (is_array($value)) {
                    return empty($value) ? null : $this->filterEmptyValue($value);
                }

                return $value;
            })
            ->filter(fn($value) => $value)->all();
    }
}
