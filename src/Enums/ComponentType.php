<?php

namespace AutoDocumentation\Enums;

enum ComponentType
{
    case parameters;
    case schemas;
    case responses;
    //todo add securitySchemes as Component
//    case securitySchemes;
}
