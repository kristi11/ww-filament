<?php

namespace App\Filament\Customer\Resources\CustomerAppointmentResource\Pages;

use App\Filament\Customer\Resources\CustomerAppointmentResource;
use App\Filament\Customer\Resources\CustomerAppointmentResource\Widgets\TeamMembersWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomerAppointments extends ListRecords
{
    protected static string $resource = CustomerAppointmentResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            TeamMembersWidget::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
