<?php

namespace AutoDocumentation\Traits;

use AutoDocumentation\Variable;
use Illuminate\Support\Collection;

trait HasVariables
{
    protected array $variables = [];

    public function variable(Variable $variable): static
    {
        $this->variables[$variable->getName()] = $variable;

        return $this;
    }

    public function variables(array $variables): static
    {
        foreach ($variables as $variable) {
            $this->variable($variable);
        }

        return $this;
    }

    public function getVariables(): Collection
    {
        return collect($this->variables);
    }
}
