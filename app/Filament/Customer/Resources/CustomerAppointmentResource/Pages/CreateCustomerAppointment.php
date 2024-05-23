<?php

namespace App\Filament\Customer\Resources\CustomerAppointmentResource\Pages;

use App\Filament\Customer\Resources\CustomerAppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomerAppointment extends CreateRecord
{
    protected static string $resource = CustomerAppointmentResource::class;
}
