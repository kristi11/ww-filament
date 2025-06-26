<?php

namespace App\Enums;

enum Weight: string
{
    case LIGHT = 'Light';
    case MEDIUM = 'Medium';
    case HEAVY = 'Heavy';
    case ULTRA_LIGHT = 'Ultra Light';
    case ULTRA_HEAVY = 'Ultra Heavy';

    public function getLabel(): string
    {
        return match ($this) {
            self::LIGHT => 'Light',
            self::MEDIUM => 'Medium',
            self::HEAVY => 'Heavy',
            self::ULTRA_LIGHT => 'Ultra Light',
            self::ULTRA_HEAVY => 'Ultra Heavy',
        };
    }
}
