<?php

namespace AutoDocumentation\Responses\Components;

use AutoDocumentation\Components\ResponseComponent;
use AutoDocumentation\Responses\Response;

class ResourceNotFoundResponse extends ResponseComponent
{
    public function content(): Response
    {
        return Response::make(404)
            ->description('A resource with the specified ID was not found.');
    }
}
