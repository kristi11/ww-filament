<?php

namespace App\Enums;

enum Age: string
{
    case BABY = 'Baby';
    case TODDLER = 'Toddler';
    case KIDS = 'Kids';
    case TEEN = 'Teen';
    case ADULT = 'Adult';
    case SENIOR = 'Senior';

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
