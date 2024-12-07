<?php

namespace App\Enums;

enum MemorySize: string
{
    case FOUR_GB = '4GB';
    case EIGHT_GB = '8GB';
    case SIXTEEN_GB = '16GB';
    case THIRTYTWO_GB = '32GB';

    public function getLabel(): string {
        return match($this) {
            self::FOUR_GB => '4GB',
            self::EIGHT_GB => '8GB',
            self::SIXTEEN_GB => '16GB',
            self::THIRTYTWO_GB => '32GB',
        };
    }
}
