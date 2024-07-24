<?php

namespace AutoDocumentation\Enums;

enum ComponentType: string
{
    case SCHEMA = 'schemas';
    case RESPONSE = 'responses';
    case PARAMETER = 'parameters';
    case EXAMPLES = 'examples';
    case REQUEST = 'requestBodies';
    case HEADER = 'headers';
    case SECURITY = 'securitySchemes';
    case LINKS = 'links';
    case CALLBACKS = 'callbacks';
}
