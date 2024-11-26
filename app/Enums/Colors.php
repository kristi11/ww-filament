<?php

namespace App\Enums;

enum Colors: string
{
    case RED = 'Red';
    case GREEN = 'Green';
    case BLUE = 'Blue';
    case YELLOW = 'Yellow';
    case ORANGE = 'Orange';
    case PURPLE = 'Purple';
    case PINK = 'Pink';
    case BLACK = 'Black';
    case WHITE = 'White';
    case GREY = 'Grey';
    case BROWN = 'Brown';
    case BEIGE = 'Beige';
    case INDIGO = 'Indigo';
    case VIOLET = 'Violet';
    case TURQUOISE ='Turquoise';
    case GOLD = 'Gold';
    case SILVER = 'Silver';
    case PEACH = 'Peach';
    case LAVENDER = 'Lavender';
    case CYAN = 'Cyan';
    case TAN = 'Tan';
    case OLIVE = 'Olive';
    case MAROON = 'Maroon';
    case TEAL = 'Teal';
    case ROSE = 'Rose';
    case CORAL = 'Coral';
    case AUBURN = 'Auburn';
    case CHARTREUSE = 'Chartreuse';
    case FUCHSIA = 'Fuchsia';
    case LIME = 'Lime';
    case SALMON = 'Salmon';
    case SCARLET = 'Scarlet';
    case AQUA = 'Aqua';
    case CRIMSON = 'Crimson';
    case EMERALD = 'Emerald';
    case JADE = 'Jade';
    case MAGENTA = 'Magenta';
    case MAUVE = 'Mauve';
    case OLIVE_DRAB = 'Olive Drab';
    case PEARL = 'Pearl';
    case PERIWINKLE = 'Periwinkle';
    case RUBY = 'Ruby';
    case SAPPHIRE = 'Sapphire';
    case SEA_GREEN = 'Sea Green';
    case SLATE_GREY = 'Slate Grey';
    case COBALT_BLUE = 'Cobalt Blue';

    public function getLabel(): ?string
    {
        return $this->name;
    }
}

