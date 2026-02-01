<?php

namespace AutoDocumentation\Requests;

use AutoDocumentation\Content\ApplicationJson;
use AutoDocumentation\Schemas\ObjectSchema;

class JsonRequest extends Request
{
    public static function make(array $properties = []): static
    {
        $instance = new static();
        $instance->content([
            ApplicationJson::make(ObjectSchema::make($properties)),
        ]);

        return $instance;
    }
}
