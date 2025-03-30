<?php

namespace App\Filament\Customer\Resources\CustomerAppointmentResource\Pages;

use App\Filament\Customer\Resources\CustomerAppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomerAppointment extends EditRecord
{
    protected static string $resource = CustomerAppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
