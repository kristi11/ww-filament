<?php

namespace App\Enums;

enum Dimensions: string
{
    case Compact = 'Compact';
    case Standard = 'Standard';
    case FullSize = 'Full Size';
    case Slim = 'Slim';

    public function getLabel(): string
    {
        return match ($this) {
            self::Compact => 'Compact Size',
            self::Standard => 'Standard Size',
            self::FullSize => 'Full Size',
            self::Slim => 'Slim Profile',
        };
    }
}
