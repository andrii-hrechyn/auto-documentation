<?php

namespace AutoDocumentation\Parameters;

use AutoDocumentation\Contracts\Resolvable;
use AutoDocumentation\Enums\Type;

class Parameter implements Resolvable
{
    public static function make(string $name, string $in): static
    {
        return new static($name, $in);
    }

    public function __construct(
        public readonly string $name,
        public readonly string $in,
        protected Type $type = Type::string,
        protected string $example = '',
        protected array $examples = [],
        protected string $description = '',
        protected bool $required = false,
        protected bool $allowEmptyValue = false,
        protected bool $deprecated = false
    ) {

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

    public function description(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function required(): self
    {
        $this->required = true;

        return $this;
    }

    public function allowEmptyValue(): self
    {
        $this->allowEmptyValue = true;

        return $this;
    }

    public function deprecated(): self
    {
        $this->deprecated = true;

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