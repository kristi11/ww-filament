<?php

namespace App\Filament\Resources\FAQdataResource\Pages;

use App\Filament\Resources\FAQdataResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFAQdata extends EditRecord
{
    protected static string $resource = FAQdataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
