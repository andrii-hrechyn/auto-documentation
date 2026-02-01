<?php

namespace AutoDocumentation\Responses;

use AutoDocumentation\Components\ResponseComponent;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

class ResponsesCollection implements Arrayable
{
    protected Collection $responses;

    public function __construct(array $responses = [])
    {
        $this->responses = new Collection();

        foreach ($responses as $item) {
            $this->add($item);
        }
    }

    public function add(Response|ResponseComponent $response): static
    {
        $this->responses[$response->getName()] = $response;

        return $this;
    }

    public function toArray(): array
    {
        return $this->responses->toArray();
    }
}
