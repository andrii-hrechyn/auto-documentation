<?php

namespace AutoDocumentation\Enums;

enum Type: string
{
    case INTEGER = 'integer';
    case NUMBER = 'number';
    case STRING = 'string';
    case BOOLEAN = 'boolean';
    case OBJECT = 'object';
    case ARRAY = 'array';
}
