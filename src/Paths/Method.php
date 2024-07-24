<?php

namespace AutoDocumentation\Paths;

use AutoDocumentation\Components\ResponseComponent;
use AutoDocumentation\Request;
use AutoDocumentation\Responses\Response;
use AutoDocumentation\Traits\HasDeprecated;
use AutoDocumentation\Traits\HasDescription;
use AutoDocumentation\Traits\HasExternalDocs;
use AutoDocumentation\Traits\HasParameters;
use AutoDocumentation\Traits\HasSecurity;
use AutoDocumentation\Traits\HasServers;
use AutoDocumentation\Traits\HasSummary;
use AutoDocumentation\Traits\HasTags;
use Illuminate\Support\Collection;

class Method
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
    protected array $responses = [];

    public function __construct(string $method)
    {
        if (!in_array($method, $this->availableMethods)) {
            //todo throw exception
        }

        $this->method = $method;
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

    public function getRequest(): ?Request
    {
        return $this->request;
    }

    public function response(Response|ResponseComponent $response): static
    {
        $this->responses[] = $response;

        return $this;
    }

    public function responses(array $responses): static
    {
        foreach ($responses as $response) {
            $this->response($response);
        }

        return $this;
    }

    public function getResponses(): Collection
    {
        return collect($this->responses);
    }
}
