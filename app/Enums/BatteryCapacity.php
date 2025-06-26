<?php

namespace App\Enums;

enum BatteryCapacity: string
{
    case TwoThousand = '2000mAh';
    case ThreeThousand = '3000mAh';
    case FourThousand = '4000mAh';
    case FiveThousand = '5000mAh';
    case SixThousand = '6000mAh';

    public function getLabel(): string
    {
        return match ($this) {
            self::TwoThousand => '2000 mAh',
            self::ThreeThousand => '3000 mAh',
            self::FourThousand => '4000 mAh',
            self::FiveThousand => '5000 mAh',
            self::SixThousand => '6000 mAh',
        };
    }
}
