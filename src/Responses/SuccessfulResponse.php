<?php

namespace AutoDocumentation\Responses;

class SuccessfulResponse extends Response
{
    public static function make(int $statusCode = 200): static
    {
        return parent::make($statusCode)->description('Successful operation');
    }
}
