<?php

namespace App\Filament\Team\Resources\TeamAppointmentsResource\Pages;

use App\Filament\Team\Resources\TeamAppointmentsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTeamAppointments extends EditRecord
{
    protected static string $resource = TeamAppointmentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
