<?php

namespace App\Enums;

enum ProcessorType: string
{
    case INTEL_I5 = 'Intel i5';
    case INTEL_I7 = 'Intel i7';
    case INTEL_I9 = 'Intel i9';
    case AMD_RYZEN_5 = 'AMD Ryzen 5';
    case AMD_RYZEN_7 = 'AMD Ryzen 7';

    public function getLabel(): string
    {
        return $this->name;
    }
}
