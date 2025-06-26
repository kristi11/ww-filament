<?php

namespace App\Enums;

enum Material: string
{
    case COTTON = 'Cotton';
    case POLYESTER = 'Polyester';
    case SILK = 'Silk';
    case WOOD = 'Wood';
    case METAL = 'Metal';
    case PLASTIC = 'Plastic';
    case SILVER = 'Silver';
    case GOLD = 'Gold';
    case PLATINUM = 'Platinum';
    case LEATHER = 'Leather';
    case STONE = 'Stone';
    case GLASS = 'Glass';
    case DENIM = 'Denim';
    case VELVET = 'Velvet';
    case LATEX = 'Latex';
    case RUBBER = 'Rubber';
    case CASHMERE = 'Cashmere';
    case LINEN = 'Linen';
    case WOOL = 'Wool';
    case FUR = 'Fur';

    public function getLabel(): string
    {
        return match ($this) {
            self::COTTON => 'Cotton',
            self::POLYESTER => 'Polyester',
            self::SILK => 'Silk',
            self::WOOD => 'Wood',
            self::METAL => 'Metal',
            self::PLASTIC => 'Plastic',
            self::SILVER => 'Silver',
            self::GOLD => 'Gold',
            self::PLATINUM => 'Platinum',
            self::LEATHER => 'Leather',
            self::STONE => 'Stone',
            self::GLASS => 'Glass',
            self::DENIM => 'Denim',
            self::VELVET => 'Velvet',
            self::LATEX => 'Latex',
            self::RUBBER => 'Rubber',
            self::CASHMERE => 'Cashmere',
            self::LINEN => 'Linen',
            self::WOOL => 'Wool',
            self::FUR => 'Fur',
        };
    }
}
