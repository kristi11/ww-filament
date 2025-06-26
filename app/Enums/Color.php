<?php

namespace App\Enums;

enum Color: string
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
    case TURQUOISE = 'Turquoise';
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

    public function getLabel(): string
    {
        return match ($this) {
            self::RED => 'Red',
            self::GREEN => 'Green',
            self::BLUE => 'Blue',
            self::YELLOW => 'Yellow',
            self::ORANGE => 'Orange',
            self::PURPLE => 'Purple',
            self::PINK => 'Pink',
            self::BLACK => 'Black',
            self::WHITE => 'White',
            self::GREY => 'Grey',
            self::BROWN => 'Brown',
            self::BEIGE => 'Beige',
            self::INDIGO => 'Indigo',
            self::VIOLET => 'Violet',
            self::TURQUOISE => 'Turquoise',
            self::GOLD => 'Gold',
            self::SILVER => 'Silver',
            self::PEACH => 'Peach',
            self::LAVENDER => 'Lavender',
            self::CYAN => 'Cyan',
            self::TAN => 'Tan',
            self::OLIVE => 'Olive',
            self::MAROON => 'Maroon',
            self::TEAL => 'Teal',
            self::ROSE => 'Rose',
            self::CORAL => 'Coral',
            self::AUBURN => 'Auburn',
            self::CHARTREUSE => 'Chartreuse',
            self::FUCHSIA => 'Fuchsia',
            self::LIME => 'Lime',
            self::SALMON => 'Salmon',
            self::SCARLET => 'Scarlet',
            self::AQUA => 'Aqua',
            self::CRIMSON => 'Crimson',
            self::EMERALD => 'Emerald',
            self::JADE => 'Jade',
            self::MAGENTA => 'Magenta',
            self::MAUVE => 'Mauve',
            self::OLIVE_DRAB => 'Olive Drab',
            self::PEARL => 'Pearl',
            self::PERIWINKLE => 'Periwinkle',
            self::RUBY => 'Ruby',
            self::SAPPHIRE => 'Sapphire',
            self::SEA_GREEN => 'Sea Green',
            self::SLATE_GREY => 'Slate Grey',
            self::COBALT_BLUE => 'Cobalt Blue',
        };
    }
}
