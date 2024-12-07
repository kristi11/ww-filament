<?php

namespace App\Enums;

enum CoreCount: string
{
    case QUAD_CORE = '4';
    case HEXA_CORE = '6';
    case OCTA_CORE = '8';

    public function getLabel(): string {
        return match($this) {
            self::QUAD_CORE => 'Quad Core',
            self::HEXA_CORE => 'Hexa Core',
            self::OCTA_CORE => 'Octa Core',
        };
    }
}
