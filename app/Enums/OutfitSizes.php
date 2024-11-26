<?php

namespace App\Enums;

enum OutfitSizes: string
{
    case XXS = 'XXS';
    case XS = 'XS';
    case S = 'S';
    case M = 'M';
    case L = 'L';
    case XL = 'XL';
    case XXL = 'XXL';
    case XXXL = 'XXXL';
    case JUNIOR = 'Junior';
    case PETITE = 'Petite';
    case PLUS_SIZE = 'Plus Size';
    case KING_SIZE = 'King Size';
    case CUSTOM = 'Custom';

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
