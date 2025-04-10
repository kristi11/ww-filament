<?php

namespace App\Filament\Widgets;

use Cmsmaxinc\FilamentSystemVersions\Filament\Widgets\DependencyWidget as BaseDependencyWidget;

class CustomDependencyWidget extends BaseDependencyWidget
{
    protected string|int|array $columnSpan = 'full'; // 'full', 1, 3
    protected static ?int $sort = 2;
}
