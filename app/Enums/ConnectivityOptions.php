<?php

namespace App\Enums;

enum ConnectivityOptions: string
{
    case WiFi = 'WiFi';
    case Bluetooth = 'Bluetooth';
    case NFC = 'NFC';
    case FourG = '4G';
    case FiveG = '5G';

    public function getLabel(): string
    {
        return match ($this) {
            self::WiFi => 'Wi-Fi',
            self::Bluetooth => 'Bluetooth',
            self::NFC => 'Near Field Communication',
            self::FourG => '4G Network',
            self::FiveG => '5G Network',
        };
    }
}
