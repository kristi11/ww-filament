<?php

namespace App\Filament\Customer\Resources\CustomerAppointmentResource\Pages;

use App\Filament\Customer\Resources\CustomerAppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomerAppointments extends ListRecords
{
    protected static string $resource = CustomerAppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
