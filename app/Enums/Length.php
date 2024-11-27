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

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
