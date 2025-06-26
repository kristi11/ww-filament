<?php

namespace App\Enums;

enum Style: string
{
    case POLO = 'Polo';
    case BUTTON_UP = 'Button-Up';
    case LONG_SLEEVE = 'Long-sleeve';
    case SHORT_SLEEVE = 'Short-sleeve';
    case HOODIE = 'Hoodie';
    case SWEATSHIRT = 'Sweatshirt';
    case TANK_TOP = 'Tank Top';
    case TURTLENECK = 'Turtleneck';

    public function getLabel(): string
    {
        return match ($this) {
            self::POLO => 'Polo',
            self::BUTTON_UP => 'Button-Up',
            self::LONG_SLEEVE => 'Long-sleeve',
            self::SHORT_SLEEVE => 'Short-sleeve',
            self::HOODIE => 'Hoodie',
            self::SWEATSHIRT => 'Sweatshirt',
            self::TANK_TOP => 'Tank Top',
            self::TURTLENECK => 'Turtleneck',
        };
    }
}
