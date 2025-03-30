<?php

namespace App\Enums;

enum Volume: string
{
    case MILLILITER = 'Milliliter';
    case LITER = 'Liter';
    case CUBIC_METER = 'Cubic Meter';
    case TEASPOON = 'Teaspoon';
    case TABLESPOON = 'Tablespoon';
    case FLUID_OUNCE = 'Fluid Ounce';
    case CUP = 'Cup';
    case PINT = 'Pint';
    case QUART = 'Quart';
    case GALLON = 'Gallon';

    public function getLabel(): string {
        return match($this) {
            self::MILLILITER => 'Milliliter',
            self::LITER => 'Liter',
            self::CUBIC_METER => 'Cubic Meter',
            self::TEASPOON => 'Teaspoon',
            self::TABLESPOON => 'Tablespoon',
            self::FLUID_OUNCE => 'Fluid Ounce',
            self::CUP => 'Cup',
            self::PINT => 'Pint',
            self::QUART => 'Quart',
            self::GALLON => 'Gallon',
        };
    }
}
