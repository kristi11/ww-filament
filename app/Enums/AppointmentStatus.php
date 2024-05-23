<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;

enum AppointmentStatus: string implements HasColor
{
    case Pending = 'pending';
    case Confirmed = 'confirmed';
    case Rejected = 'rejected';
    case Completed = 'completed';
    case Canceled = 'canceled';
    case Rescheduled = 'rescheduled';
    case NoShow = 'no show';

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Pending => Color::Zinc,
            self::Confirmed => Color::Green,
            self::Rejected => Color::Red,
            self::Completed => Color::Blue,
            self::Canceled => Color::Red,
            self::Rescheduled => Color::Amber,
            self::NoShow => Color::Orange,
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Pending => 'heroicon-o-clock',
            self::Confirmed => 'heroicon-o-check-circle',
            self::Rejected => 'heroicon-o-x-circle',
            self::Completed => 'heroicon-o-check',
            self::Canceled => 'heroicon-o-x-circle',
            self::Rescheduled => 'heroicon-o-arrow-path',
            self::NoShow => 'heroicon-o-exclamation-triangle',
        };
    }
}
