<?php

namespace AutoDocumentation\Parameters;

use AutoDocumentation\Contracts\Resolvable;
use AutoDocumentation\Enums\Type;
use AutoDocumentation\Traits\CanBeDeprecated;
use AutoDocumentation\Traits\CanBeRequired;
use AutoDocumentation\Traits\HasDescription;

class Parameter implements Resolvable
{
    use HasDescription;
    use CanBeDeprecated;
    use CanBeRequired;

    protected bool $allowEmptyValue = false;
    protected Type $type = Type::string;
    protected ?string $example = null;
    protected array $examples = [];

    public static function make(string $name, string $in): static
    {
        return new static($name, $in);
    }

    public function __construct(public readonly string $name, public readonly string $in)
    {
    }

    public function type(Type $type)
    {
        $this->type = $type;

        return $this;
    }

    public function example(string $example): self
    {
        $this->example = $example;

        return $this;
    }

    public function examples(array $examples): self
    {
        $this->examples = $examples;

        return $this;
    }

    public function allowEmptyValue(): self
    {
        $this->allowEmptyValue = true;

        return $this;
    }

    public function resolve(): array
    {
        return [
            'name'            => $this->name,
            'in'              => $this->in,
            'description'     => $this->description,
            'required'        => $this->required,
            'deprecated'      => $this->deprecated,
            'allowEmptyValue' => $this->allowEmptyValue,
            'example'         => $this->example,
            'examples'        => $this->examples,
            'schema'          => [
                'type' => $this->type->name,
            ],
        ];
    }
}