<?php

namespace AutoDocumentation\Enums;

enum ApiKeySecuritySchemeIn: string
{
    case QUERY = 'query';
    case HEADER = 'header';
    case COOKIE = 'cookie';
}
