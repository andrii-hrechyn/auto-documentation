<?php

namespace AutoDocumentation\Paths;

use AutoDocumentation\Components\SchemaComponent;
use AutoDocumentation\OpenApi;
use AutoDocumentation\RequestBodies\MediaTypes\ApplicationJson;
use AutoDocumentation\RequestBodies\MediaTypes\MultipartFormData;
use AutoDocumentation\RequestBodies\RequestBody;
use AutoDocumentation\Responses\NoContentResponse;
use AutoDocumentation\Responses\SuccessfulResponse;
use AutoDocumentation\Schemas\Schema;
use Illuminate\Support\Collection;

class BasePath
{
    protected string $group = 'other';
    protected array $tags = [];
    protected Collection $parameters;
    protected ?RequestBody $requestBody = null;
    protected Collection $responses;
    protected ?string $security = null;

    public function __construct(
        public readonly string $method,
        public readonly string $path,
        public readonly string $summary
    ) {
        $this->parameters = new Collection();
        $this->responses = new Collection();
    }

    public function group(string $group): self
    {
        $this->group = $group;

        return $this;
    }

    public function tag(string $tag): self
    {
        $this->tags[] = $tag;

        return $this;
    }

    public function tags(array $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    public function parameters(array $parameters): self
    {
        $this->parameters = collect($parameters);

        return $this;
    }

    public function jsonRequest(Schema|SchemaComponent|array $schema): self
    {
        return $this->requestBody(RequestBody::make(ApplicationJson::make($schema)));
    }

    public function multipartFormData(Schema|SchemaComponent|array $schema): self
    {
        return $this->requestBody(RequestBody::make(MultipartFormData::make($schema)));
    }

    public function requestBody(RequestBody $requestBody): self
    {
        $this->requestBody = $requestBody;

        return $this;
    }

    public function successfulResponse(Schema|SchemaComponent|array $schema = null)
    {
        $response = SuccessfulResponse::make();

        if ($schema) {
            $response->schema($schema);
        }

        return $this->responses([$response]);
    }

    public function noContentResponse()
    {
        $response = NoContentResponse::make();

        return $this->responses([$response]);
    }

    public function responses(array $responses): self
    {
        $this->responses = collect($responses);

        return $this;
    }

    public function secure(string $securityScheme = null): self
    {
        $this->security = $securityScheme ?? $this->defaultSecurity();

        return $this;
    }

    /**
     * @return string
     */
    public function getGroup(): string
    {
        return $this->group;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function getParameters(): Collection
    {
        return $this->parameters;
    }

    public function getRequestBody(): ?RequestBody
    {
        return $this->requestBody;
    }

    public function getResponses(): Collection
    {
        return $this->responses;
    }

    /**
     * @return string|null
     */
    public function getSecurity(): ?string
    {
        return $this->security;
    }

    private function defaultSecurity(): string
    {
        return OpenApi::instance()->defaultSecurityScheme()->name;
    }
}