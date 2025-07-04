<?php

namespace App\Enums;

enum GraphicCardType: string
{
    case INTEL_HD_GRAPHICS = 'Intel HD Graphics';
    case AMD_RADEON = 'AMD Radeon';
    case NVIDIA_GE_FORCE = 'NVIDIA GeForce';

    public function getLabel(): string
    {
        return match ($this) {
            self::INTEL_HD_GRAPHICS => 'Intel HD Graphics',
            self::AMD_RADEON => 'AMD Radeon',
            self::NVIDIA_GE_FORCE => 'NVIDIA GeForce',
        };
    }
}
