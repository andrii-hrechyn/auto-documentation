<?php

namespace AutoDocumentation\Responses\Components;

use AutoDocumentation\Components\ResponseComponent;
use AutoDocumentation\Responses\NoContentResponse as BaseNoContentResponse;
use AutoDocumentation\Responses\Response;

class NoContentResponse extends ResponseComponent
{
    public function content(): Response
    {
        return BaseNoContentResponse::make();
    }
}
