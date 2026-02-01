<?php

namespace AutoDocumentation\Enums;

enum Format: string
{
    case INT32 = 'int32';
    case INT64 = 'int64';
    case FLOAT = 'float';
    case DOUBLE = 'double';
    case BYTE = 'byte';
    case BINARY = 'binary';
    case DATE = 'date';
    case DATE_TIME = 'date-time';
    case PASSWORD = 'password';

    public static function availableFormatsByType(Type $type): array
    {
        return match ($type) {
            Type::INTEGER => [self::INT32, self::INT64],
            Type::NUMBER  => [self::FLOAT, self::DOUBLE],
            Type::STRING  => [self::BYTE, self::BINARY, self::DATE, self::DATE_TIME, self::PASSWORD],
            default       => []
        };
    }
}
