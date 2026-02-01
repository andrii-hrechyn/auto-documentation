<?php

namespace AutoDocumentation\Base;

use AutoDocumentation\Security\SanctumAuth;

abstract class AuthPathComponent extends PathComponent
{
    public function methods(): array
    {
        $security = new SanctumAuth();

        $methods = parent::methods();

        foreach ($methods as $method) {
            $method->security($security);
        }

        return $methods;
    }
}
