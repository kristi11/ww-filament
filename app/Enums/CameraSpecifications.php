<?php

namespace App\Enums;

enum CameraSpecifications: string
{
    case TwelveMP = '12MP';
    case TwentyFourMP = '24MP';
    case FortyEightMP = '48MP';
    case OneHundredEightMP = '108MP';
    case FourKVideo = '4K Video';

    public function getLabel(): string
    {
        return match ($this) {
            self::TwelveMP => '12 Megapixels',
            self::TwentyFourMP => '24 Megapixels',
            self::FortyEightMP => '48 Megapixels',
            self::OneHundredEightMP => '108 Megapixels',
            self::FourKVideo => '4K Video Recording',
        };
    }
}
