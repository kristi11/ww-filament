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
        return $this->name;
    }
}
