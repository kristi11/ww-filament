<?php

namespace App\Enums;

enum Patterns: string
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

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
