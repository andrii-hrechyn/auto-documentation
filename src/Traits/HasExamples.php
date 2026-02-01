<?php

namespace AutoDocumentation\Traits;

use AutoDocumentation\Example;

trait HasExamples
{
    protected array $examples = [];

    private function addExample(Example $example): static
    {
        $this->examples[] = $example;

        return $this;
    }

    public function examples(array $examples): static
    {
        foreach ($examples as $example) {
            $this->addExample($example);
        }

        return $this;
    }

    public function getExamples(): array
    {
        return $this->examples;
    }
}
