<?php

namespace App\Enums;

enum Length: string
{
    case SHORT = 'Short';
    case REGULAR = 'Regular';
    case LONG = 'Long';
    case KNEE_LENGTH = 'Knee Length';
    case ANKLE_LENGTH = 'Ankle Length';
    case FLOOR_LENGTH = 'Floor Length';
    case CROPPED = 'Cropped';

    public function getLabel(): string {
        return match($this) {
            self::SHORT => 'Short',
            self::REGULAR => 'Regular',
            self::LONG => 'Long',
            self::KNEE_LENGTH => 'Knee Length',
            self::ANKLE_LENGTH => 'Ankle Length',
            self::FLOOR_LENGTH => 'Floor Length',
            self::CROPPED => 'Cropped',
        };
    }
}
