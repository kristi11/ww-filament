<?php

namespace App\Enums;

enum Pattern: string
{
    case SOLID = 'Solid';
    case STRIPED = 'Striped';
    case CHECKERED = 'Checkered';
    case POLKA_DOT = 'Polka Dot';
    case FLORAL = 'Floral';
    case GEOMETRIC = 'Geometric';
    case ABSTRACT = 'Abstract';
    case ANIMAL_PRINT = 'Animal Print';
    case CAMOUFLAGE = 'Camouflage';
    case HERRINGBONE = 'Herringbone';
    case TIE_DYE = 'Tie-Dye';
    case PAISLEY = 'Paisley';
    case TEXTURED = 'Textured';

    public function getLabel(): string
    {
        return match ($this) {
            self::SOLID => 'Solid',
            self::STRIPED => 'Striped',
            self::CHECKERED => 'Checkered',
            self::POLKA_DOT => 'Polka Dot',
            self::FLORAL => 'Floral',
            self::GEOMETRIC => 'Geometric',
            self::ABSTRACT => 'Abstract',
            self::ANIMAL_PRINT => 'Animal Print',
            self::CAMOUFLAGE => 'Camouflage',
            self::HERRINGBONE => 'Herringbone',
            self::TIE_DYE => 'Tie-Dye',
            self::PAISLEY => 'Paisley',
            self::TEXTURED => 'Textured',
        };
    }
}
