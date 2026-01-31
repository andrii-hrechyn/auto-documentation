<?php

namespace AutoDocumentation\Requests;

use AutoDocumentation\Traits\HasContent;
use AutoDocumentation\Traits\HasDescription;
use AutoDocumentation\Traits\HasRequired;
use Illuminate\Contracts\Support\Arrayable;

class Request implements Arrayable
{
    use HasDescription;
    use HasRequired;
    use HasContent;

    public static function make(): static
    {
        return new static();
    }

    public function toArray(): array
    {
        return [
            'required'    => $this->required,
            'description' => $this->description,
            'content'     => $this->content->toArray(),
        ];
    }
}
