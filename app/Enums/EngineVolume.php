<?php

namespace App\Enums;

enum EngineVolume: string
{
    case LITER = 'Liter';
    case CUBIC_CENTIMETER = 'Cubic Centimeter';
    case CUBIC_INCH = 'Cubic Inch';

    public function getLabel(): string {
        return match($this) {
            self::LITER => 'Liter',
            self::CUBIC_CENTIMETER => 'Cubic Centimeter',
            self::CUBIC_INCH => 'Cubic Inch',
        };
    }
}
