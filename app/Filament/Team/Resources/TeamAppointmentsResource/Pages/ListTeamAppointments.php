<?php

namespace App\Filament\Team\Resources\TeamAppointmentsResource\Pages;

use App\Filament\Team\Resources\TeamAppointmentsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTeamAppointments extends ListRecords
{
    protected static string $resource = TeamAppointmentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
