<?php

namespace App\Enums;

enum Material: string
{
    case COTTON       = 'Cotton';
    case POLYESTER    = 'Polyester';
    case SILK         = 'Silk';
    case WOOD         = 'Wood';
    case METAL        = 'Metal';
    case PLASTIC      = 'Plastic';
    case SILVER       = 'Silver';
    case GOLD         = 'Gold';
    case PLATINUM     = 'Platinum';
    case LEATHER      = 'Leather';
    case STONE        = 'Stone';
    case GLASS        = 'Glass';
    case DENIM        = 'Denim';
    case VELVET       = 'Velvet';
    case LATEX        = 'Latex';
    case RUBBER       = 'Rubber';
    case CASHMERE     = 'Cashmere';
    case LINEN        = 'Linen';
    case WOOL         = 'Wool';
    case FUR          = 'Fur';

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
