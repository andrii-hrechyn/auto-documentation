<?php

namespace AutoDocumentation\Responses;

use AutoDocumentation\Components\SchemaComponent;
use AutoDocumentation\Contracts\Resolvable;
use AutoDocumentation\Reference;
use AutoDocumentation\Schemas\ObjectSchema;
use AutoDocumentation\Schemas\Schema;
use AutoDocumentation\Traits\HasDescription;

class Response implements Resolvable
{
    use HasDescription;

    protected string $contentType;
    protected Schema|Reference|null $schema = null;

    public static function make(int $statusCode): self
    {
        return new self($statusCode);
    }

    private function __construct(
        public readonly int $statusCode
    ) {
    }

    public function contentType(string $contentType): self
    {
        $this->contentType = $contentType;

        return $this;
    }

    public function schema(Schema|SchemaComponent|array $schema): self
    {
        if (is_array($schema)) {
            $schema = ObjectSchema::make($schema);
        }

        if ($schema instanceof SchemaComponent) {
            $schema = $schema->reference();
        }

        $this->schema = $schema;

        return $this;
    }

    public function resolve(): array
    {
        return [
            (string) $this->statusCode => [
                'description' => $this->description,
                ...$this->content(),
            ],
        ];
    }

    private function content(): array
    {
        if (!$this->schema) {
            return [];
        }

        return [
            'content' => [
                    $this->contentType ?? $this->defaultContentType() => [
                    'schema' => $this->schema->resolve(),
                ],
            ],
        ];
    }

    private function defaultContentType(): string
    {
        //todo move it to config
        return 'application/json';
    }
}