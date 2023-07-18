<?php

namespace AutoDocumentation\Paths;

use AutoDocumentation\Components\SchemaComponent;
use AutoDocumentation\Components\SecuritySchemeComponent;
use AutoDocumentation\Contracts\Resolvable;
use AutoDocumentation\OpenApi;
use AutoDocumentation\RequestBodies\MediaTypes\ApplicationJson;
use AutoDocumentation\RequestBodies\MediaTypes\MultipartFormData;
use AutoDocumentation\RequestBodies\RequestBody;
use AutoDocumentation\Responses\NoContentResponse;
use AutoDocumentation\Responses\SuccessfulResponse;
use AutoDocumentation\Schemas\Schema;
use AutoDocumentation\Server;
use AutoDocumentation\Traits\CanBeDeprecated;
use AutoDocumentation\Traits\HasDescription;
use AutoDocumentation\Traits\HasExternalDocs;
use Illuminate\Support\Collection;

class BasePath
{
    use HasExternalDocs;
    use HasDescription;
    use CanBeDeprecated;

    public readonly string $method;
    public readonly string $path;
    protected array $tags = [];
    public readonly string $summary;
    protected ?string $operationId = null;
    protected Collection $parameters;
    protected ?RequestBody $requestBody = null;
    protected Collection $responses;
    protected ?SecuritySchemeComponent $security = null;
    protected array $servers = [];
    protected string $group = 'other';

    public function __construct(string $method, string $path, string $summary)
    {
        $this->method = $method;
        $this->path = $path;
        $this->summary = $summary;
        $this->parameters = new Collection();
        $this->responses = new Collection();
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

    public function operationId(string $operationId): self
    {
        $this->operationId = $operationId;

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

    public function secure(SecuritySchemeComponent $securityScheme = null): self
    {
        $this->security = $securityScheme ?? $this->defaultSecurityScheme();

        return $this;
    }

    public function server(Server $server): Server
    {
        $this->servers[] = $server;

        return $server;
    }

    public function group(string $group): self
    {
        $this->group = $group;

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

    public function resolve(): array
    {
        $parameters = $this->parameters->map(fn(Resolvable $resolvable) => $resolvable->resolve());
        $responses = $this->responses->mapWithKeys(fn(Resolvable $resolvable) => $resolvable->resolve());

        return [
            'tags'         => $this->tags,
            'summary'      => $this->summary,
            'description'  => $this->description,
            'externalDocs' => $this->externalDocs,
            'operationId'  => $this->operationId,
            'parameters'   => $parameters->toArray(),
            'requestBody'  => $this->requestBody?->resolve(),
            'responses'    => $responses->toArray(),
            'deprecated'   => $this->deprecated,
            'security'     => $this->security ? [$this->security->resolve()] : null,
            'servers'      => $this->prepareServers(),
        ];
    }

    public function prepareServers(): array
    {
        return array_map(fn(Server $server) => $server->toArray(), $this->servers);
    }

    private function defaultSecurityScheme(): ?SecuritySchemeComponent
    {
        return OpenApi::instance()->getDefaultSecurityScheme();
    }
}