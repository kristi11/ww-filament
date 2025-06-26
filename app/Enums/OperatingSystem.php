<?php

namespace App\Enums;

enum OperatingSystem: string
{
    case Windows = 'Windows';
    case MacOS = 'macOS';
    case Linux = 'Linux';
    case Android = 'Android';
    case IOS = 'iOS';

    public function getLabel(): string
    {
        return match ($this) {
            self::Windows => 'Windows OS',
            self::MacOS => 'Mac OS',
            self::Linux => 'Linux OS',
            self::Android => 'Android OS',
            self::IOS => 'iOS',
        };
    }
}
