<?php

namespace App\Filament\Widgets;

use Cmsmaxinc\FilamentSystemVersions\Filament\Widgets\DependencyWidget as BaseDependencyWidget;

class CustomDependencyWidget extends BaseDependencyWidget
{
    // Override the column span to control the width
    protected string|int|array $columnSpan = 'full'; // Or 'full', 1, 3
    protected static ?int $sort = 2;
}
