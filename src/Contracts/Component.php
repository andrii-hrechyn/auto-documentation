<?php

namespace AutoDocumentation\Contracts;

use AutoDocumentation\Enums\ComponentType;
use AutoDocumentation\Reference;

interface Component
{
    public function name(): string;

    public function type(): ComponentType;

    public function content(): Resolvable;

    public function reference(): Reference;
}