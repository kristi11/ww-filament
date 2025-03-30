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
        return 4;
    }
    protected function getHeading(): string
    {
        return 'Business Information';
    }
    protected function getDescription(): string
    {
        return 'The total business information';
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Appointments', Appointment::count())
                ->description('Number of appointments')
                ->descriptionIcon('heroicon-o-calendar-days')
                ->url('/admin/appointments'),
            Stat::make('Business hours', BusinessHour::count())
                ->description('Days that hours are set for')
                ->descriptionIcon('heroicon-o-briefcase')
                ->url('/admin/business-hours'),
            Stat::make('Images', Gallery::count())
                ->description('Services with images')
                ->descriptionIcon('heroicon-o-photo')
                ->url('/admin/gallery'),
            Stat::make('Roles', Role::count())
                ->description('Number of user roles')
                ->descriptionIcon('heroicon-o-user-circle')
                ->url('/admin/shield/roles'),
        ];
    }
}
