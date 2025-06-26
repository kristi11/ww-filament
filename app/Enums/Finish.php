<?php

namespace App\Enums;

enum Finish: string
{
    case MATTE = 'Matte';
    case GLOSSY = 'Glossy';
    case SATIN = 'Satin';
    case TEXTURED = 'Textured';
    case POLISHED = 'Polished';
    case RAW = 'Raw';
    case OILED = 'Oiled';
    case WEATHERED = 'Weathered';

    public function getLabel(): string
    {
        return match ($this) {
            self::MATTE => 'Matte',
            self::GLOSSY => 'Glossy',
            self::SATIN => 'Satin',
            self::TEXTURED => 'Textured',
            self::POLISHED => 'Polished',
            self::RAW => 'Raw',
            self::OILED => 'Oiled',
            self::WEATHERED => 'Weathered',
        };
    }
}
