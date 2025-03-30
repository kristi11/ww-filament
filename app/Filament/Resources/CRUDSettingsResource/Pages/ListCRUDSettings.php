<?php

namespace App\Filament\Resources\CRUDSettingsResource\Pages;

use App\Filament\Resources\CRUDSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCRUDSettings extends ListRecords
{
    protected static string $resource = CRUDSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Create content permission'),
        ];
    }
}
