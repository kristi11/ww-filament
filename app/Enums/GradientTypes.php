<?php

namespace App\Enums;

enum GradientTypes: string
{
    private const LINEAR = 'linear-gradient';
    //    private const RADIAL = 'radial-gradient';
    //    private const CONIC = 'conic-gradient';

    public static function gradientType(): array
    {
        return [
            self::LINEAR => 'Linear',
            //            self::RADIAL => 'Radial',
            //            self::CONIC => 'Conic',
        ];
    }
}
