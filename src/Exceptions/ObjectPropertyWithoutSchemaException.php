<?php

namespace AutoDocumentation\Exceptions;

class ObjectPropertyWithoutSchemaException extends AutoDocumentationException
{
    public function __construct(string $propertyName)
    {
        parent::__construct("Schema is required for object property [$propertyName]");
    }
}