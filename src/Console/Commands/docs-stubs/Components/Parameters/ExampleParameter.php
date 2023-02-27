<?php

namespace Docs\Components\Parameters;

use AutoDocumentation\Components\ParameterComponent;
use AutoDocumentation\Parameters\Parameter;
use AutoDocumentation\Parameters\PathParameter;

class ExampleParameter extends ParameterComponent
{
    public function content(): Parameter
    {
        return PathParameter::make('exampleParameter')
            ->required()
            ->example(3);
    }
}