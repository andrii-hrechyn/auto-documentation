<?php

namespace AutoDocumentation\Traits;

use AutoDocumentation\ExternalDocs;

trait HasExternalDocs
{
    protected ?ExternalDocs $externalDocs = null;

    public function externalDocs(ExternalDocs $externalDocs): self
    {
        $this->externalDocs = $externalDocs;

        return $this;
    }
}