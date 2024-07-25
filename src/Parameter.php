<?php

namespace AutoDocumentation;

use AutoDocumentation\Enums\ParameterIn;
use AutoDocumentation\Enums\ParameterStyle;
use AutoDocumentation\Traits\HasAllowEmptyValue;
use AutoDocumentation\Traits\HasDeprecated;
use AutoDocumentation\Traits\HasDescription;
use AutoDocumentation\Traits\HasExample;
use AutoDocumentation\Traits\HasExamples;
use AutoDocumentation\Traits\HasName;
use AutoDocumentation\Traits\HasRequired;
use Illuminate\Contracts\Support\Arrayable;

class Parameter implements Arrayable
{
    use HasName;
    use HasDescription;
    use HasRequired;
    use HasDeprecated;
    use HasAllowEmptyValue;
    use HasExample;
    use HasExamples;
    use HasRequired;

    protected ParameterIn $in;

    protected ParameterStyle $style;

    protected bool $explode = false;

    protected bool $allowReserved = false;

    public function __construct(string $name, ParameterIn $in)
    {
        $this->name($name)
            ->in($in)
            ->style(ParameterStyle::basedOnParameterIn($in));
    }

    public static function make(string $name, ParameterIn $in): static
    {
        return new static($name, $in);
    }

    public function in(ParameterIn $in): static
    {
        $this->in = $in;

        return $this;
    }

    public function getIn(): ParameterIn
    {
        return $this->in;
    }

    public function allowReserved(bool $allow = true): static
    {
        $this->allowReserved = $allow;

        return $this;
    }

    public function getAllowReserved(): bool
    {
        return $this->allowReserved;
    }

    public function style(ParameterStyle $style): static
    {
        $this->style = $style;

        return $this;
    }

    public function getStyle(): ParameterStyle
    {
        return $this->style;
    }

    public function toArray(): array
    {
        return [
            'name'            => $this->getName(),
            'in'              => $this->getIn()->value,
            'description'     => $this->getDescription(),
            'required'        => $this->isRequired(),
            'deprecated'      => $this->isDeprecated(),
            'allowEmptyValue' => $this->isAllowEmptyValue(),
            'example'         => $this->getExample(),
            'examples'        => $this->getExamples(),
        ];
    }
}
