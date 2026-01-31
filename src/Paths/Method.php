<?php

namespace AutoDocumentation\Paths;

use AutoDocumentation\Components\ResponseComponent;
use AutoDocumentation\Content\ApplicationJson;
use AutoDocumentation\Requests\Request;
use AutoDocumentation\Responses\Response;
use AutoDocumentation\Responses\ResponsesCollection;
use AutoDocumentation\Schemas\Schema;
use AutoDocumentation\Traits\HasDeprecated;
use AutoDocumentation\Traits\HasDescription;
use AutoDocumentation\Traits\HasExternalDocs;
use AutoDocumentation\Traits\HasParameters;
use AutoDocumentation\Traits\HasSecurity;
use AutoDocumentation\Traits\HasServers;
use AutoDocumentation\Traits\HasSummary;
use AutoDocumentation\Traits\HasTags;
use Illuminate\Contracts\Support\Arrayable;

class Method implements Arrayable
{
    use HasDescription;
    use HasSummary;
    use HasExternalDocs;
    use HasDeprecated;
    use HasServers;
    use HasParameters;
    use HasTags;
    use HasSecurity;

    protected array $availableMethods = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'];

    protected string $method;

    protected ?string $operationId = null;

    protected ?Request $request = null;
    protected ResponsesCollection $responses;

    public function __construct(string $method)
    {
        $method = strtolower($method);

        if (!in_array($method, $this->availableMethods)) {
            //todo throw exception
        }

        $this->method = $method;
        $this->responses = new ResponsesCollection();
    }

    public static function make(string $method): static
    {
        return new static($method);
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function operationId(string $operationId): self
    {
        $this->operationId = $operationId;

        return $this;
    }

    public function getOperationId(): ?string
    {
        return $this->operationId;
    }

    public function request(Request $request): static
    {
        $this->request = $request;

        return $this;
    }

    public function jsonRequest(Schema $schema): static
    {
        $this->request = Request::make()->content([ApplicationJson::make($schema)]);

        return $this;
    }

    public function getRequest(): ?Request
    {
        return $this->request;
    }

    public function response(Response|ResponseComponent $response): static
    {
        $this->responses->add($response);

        return $this;
    }

    public function responses(array $responses): static
    {
        foreach ($responses as $response) {
            $this->response($response);
        }

        return $this;
    }

    public function getResponses(): ResponsesCollection
    {
        return $this->responses;
    }

    public function toArray(): array
    {
        return [
            'tags'         => $this->getTags()->toArray(),
            'summary'      => $this->getSummary(),
            'description'  => $this->getDescription(),
            'externalDocs' => $this->getExternalDocs(),
            'operationId'  => $this->getOperationId(),
            'parameters'   => $this->getParameters()->values()->toArray(),
            'requestBody'  => $this->getRequest()?->toArray(),
            'responses'    => $this->getResponses()->toArray(),
            'deprecated'   => $this->isDeprecated(),
            'security'     => $this->getSecurity()?->toArray(),
            'servers'      => $this->getServers()->values()->toArray(),
        ];
    }
}
