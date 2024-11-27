<?php

namespace App\Enums;

enum Gender: string
{
    case MALE = 'Male';
    case FEMALE = 'Female';
    case UNISEX = 'Unisex';
    case KIDS = 'Kids';

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
