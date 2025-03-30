<?php

namespace App\Enums;

enum DStorage: string
{
    case BYTE = 'Byte';
    case KILOBYTE = 'Kilobyte';
    case MEGABYTE = 'Megabyte';
    case GIGABYTE = 'Gigabyte';
    case TERABYTE = 'Terabyte';

    public function getLabel(): string {
        return match($this) {
            self::BYTE => 'Byte',
            self::KILOBYTE => 'Kilobyte',
            self::MEGABYTE => 'Megabyte',
            self::GIGABYTE => 'Gigabyte',
            self::TERABYTE => 'Terabyte',
        };
    }
}
