<?php

namespace AutoDocumentation\Responses;

class NoContentResponse extends Response
{
    public static function make(int $statusCode = 204): Response
    {
        return parent::make($statusCode)->description('No Content');
    }
}