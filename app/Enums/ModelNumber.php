<?php

namespace App\Enums;

enum ModelNumber: string {
    case ModelA = 'Model_A';
    case Model1 = 'Model_1';
    case SeriesX = 'Series_X';
    case Prototype123 = 'Prototype_123';
    case Version2023 = 'Version_2023';

    public function getLabel(): string {
        return match($this) {
            self::ModelA => 'Model A',
            self::Model1 => 'Model 1',
            self::SeriesX => 'Series X',
            self::Prototype123 => 'Prototype 123',
            self::Version2023 => 'Version 2023',
        };
    }
}
