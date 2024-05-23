<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use App\Models\BusinessHour;
use App\Models\Gallery;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Spatie\Permission\Models\Role;

class BusinessInformationWidget extends BaseWidget
{
    protected function getColumns(): int
    {
        return 2;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Appointments', Appointment::count())
                ->description('The total number of appointments')
                ->descriptionIcon('heroicon-o-calendar-days'),
            Stat::make('Business hours', BusinessHour::count())
                ->description('The number of days the business has set hours for')
                ->descriptionIcon('heroicon-o-briefcase'),
            Stat::make('Images', Gallery::count())
                ->description('The total number of services with images in the gallery')
                ->descriptionIcon('heroicon-o-photo'),
            Stat::make('Roles', Role::count())
                ->description('The total number of user roles')
                ->descriptionIcon('heroicon-o-user-circle'),
        ];
    }
}
