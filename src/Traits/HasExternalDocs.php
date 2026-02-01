<?php

namespace AutoDocumentation\Traits;


use AutoDocumentation\ExternalDocs;

trait HasExternalDocs
{
    protected ?ExternalDocs $externalDocs = null;

    public function externalDocs(ExternalDocs $externalDocs): static
    {
        $this->externalDocs = $externalDocs;

        return $this;
    }

    public function getExternalDocs(): ?ExternalDocs
    {
        return $this->externalDocs;
    }
}
