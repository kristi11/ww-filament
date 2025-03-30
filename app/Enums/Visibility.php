<?php

namespace App\Enums;

enum Visibility: int
{
    case True = 1;
    case False = 0;

    public function getVisibility(): string
    {
        return match ($this) {
            self::True => 'success',
            self::False => 'danger',
        };
    }
}
