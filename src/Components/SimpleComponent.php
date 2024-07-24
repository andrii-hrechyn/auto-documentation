<?php

namespace AutoDocumentation\Components;

abstract class SimpleComponent extends Component
{
    public static function make(): static
    {
        return new static();
    }
}
