<?php

namespace AutoDocumentation\Enums;

enum ParameterStyle: string
{
    case FORM = 'form';
    case SIMPLE = 'simple';

    public static function basedOnParameterIn(ParameterIn $in): self
    {
        return match ($in) {
            ParameterIn::QUERY, ParameterIn::COOKIE => self::FORM,
            ParameterIn::PATH, ParameterIn::HEADER  => self::SIMPLE,
        };
    }
}
