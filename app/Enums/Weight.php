<?php

namespace App\Enums;

enum Weight: string
{
    case LIGHT = 'Light';
    case MEDIUM = 'Medium';
    case HEAVY = 'Heavy';
    case ULTRA_LIGHT = 'Ultra Light';
    case ULTRA_HEAVY = 'Ultra Heavy';

    public function getLabel(): ?string
    {
        return $this->name;
    }
}