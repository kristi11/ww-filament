<?php

namespace App\Filament\Resources\CRUDSettingsResource\Pages;

use App\Filament\Resources\CRUDSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCRUDSettings extends EditRecord
{
    protected static string $resource = CRUDSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
