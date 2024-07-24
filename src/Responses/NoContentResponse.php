<?php

namespace AutoDocumentation\Responses;

class NoContentResponse extends Response
{
    public static function make(int $statusCode = 204): static
    {
        return parent::make($statusCode)->description('No Content');
    }
}
