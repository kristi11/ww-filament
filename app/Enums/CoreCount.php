<?php

namespace App\Enums;

enum CoreCount: string
{
    case QUAD_CORE = '4';
    case HEXA_CORE = '6';
    case OCTA_CORE = '8';

    public function getLabel(): string
    {
        return $this->name;
    }
}
