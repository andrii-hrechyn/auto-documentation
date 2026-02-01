<?php

namespace AutoDocumentation\Responses\Components;

use AutoDocumentation\Components\ResponseComponent;
use AutoDocumentation\Responses\Response;
use AutoDocumentation\Responses\SuccessfulResponse as BaseSuccessfulResponse;

class SuccessfulResponse extends ResponseComponent
{
    public function content(): Response
    {
        return BaseSuccessfulResponse::make();
    }
}
