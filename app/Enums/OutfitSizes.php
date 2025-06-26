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

    public function getLabel(): string
    {
        return match ($this) {
            self::XXS => 'XXS',
            self::XS => 'XS',
            self::S => 'S',
            self::M => 'M',
            self::L => 'L',
            self::XL => 'XL',
            self::XXL => 'XXL',
            self::XXXL => 'XXXL',
            self::JUNIOR => 'Junior',
            self::PETITE => 'Petite',
            self::PLUS_SIZE => 'Plus Size',
            self::KING_SIZE => 'King Size',
            self::CUSTOM => 'Custom',
        };
    }
}
