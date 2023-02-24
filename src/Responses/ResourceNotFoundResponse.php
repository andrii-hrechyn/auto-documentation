<?php

namespace AutoDocumentation\Responses;

use AutoDocumentation\Components\ResponseComponent;

class ResourceNotFoundResponse extends ResponseComponent
{
    public function content(): Response
    {
        return Response::make(404)
            ->description('A resource with the specified ID was not found.');
    }
}