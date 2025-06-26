<?php

namespace App\Enums;

enum ScreenResolution: string
{
    case HD = 'HD';
    case FullHD = 'Full HD';
    case TwoK = '2K';
    case FourK = '4K';
    case EightK = '8K';

    public function getLabel(): string
    {
        return match ($this) {
            self::HD => 'High Definition',
            self::FullHD => 'Full High Definition',
            self::TwoK => '2K Resolution',
            self::FourK => '4K Resolution',
            self::EightK => '8K Resolution',
        };
    }
}
