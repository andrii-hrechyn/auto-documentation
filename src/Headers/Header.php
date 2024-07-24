<?php

namespace AutoDocumentation\Headers;

use AutoDocumentation\Traits\HasDeprecated;
use AutoDocumentation\Traits\HasDescription;
use AutoDocumentation\Traits\HasName;
use AutoDocumentation\Traits\HasRequired;

class Header
{
    use HasName;
    use HasDescription;
    use HasRequired;
    use HasDeprecated;
}
