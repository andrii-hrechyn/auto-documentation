<?php

namespace AutoDocumentation;

use AutoDocumentation\Traits\HasDescription;
use AutoDocumentation\Traits\HasExternalDocs;
use AutoDocumentation\Traits\HasName;

class Tag
{
    use HasName;
    use HasDescription;
    use HasExternalDocs;
}
