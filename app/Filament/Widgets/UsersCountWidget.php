<?php

namespace App\Filament\Widgets;

use App\Models\Service;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UsersCountWidget extends BaseWidget
{
    protected function getColumns() : int{
     return 2;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Users', User::count())
                ->description('The total number of users in the database ')
                ->descriptionIcon('heroicon-o-users'),
            Stat::make('Services', Service::count())
                ->description('The total number of services')
                ->descriptionIcon('heroicon-o-wrench-screwdriver'),
        ];
    }
}
