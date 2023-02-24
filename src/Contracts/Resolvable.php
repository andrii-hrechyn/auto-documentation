<?php

namespace AutoDocumentation\Contracts;

interface Resolvable
{
    public function resolve(): array;
}