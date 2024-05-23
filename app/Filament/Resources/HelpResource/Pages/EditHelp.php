<?php

namespace App\Filament\Resources\HelpResource\Pages;

use App\Filament\Resources\HelpResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHelp extends EditRecord
{
    protected static string $resource = HelpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
