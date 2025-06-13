<?php

namespace App\Filament\Resources\SectionPositionResource\Pages;

use App\Filament\Resources\SectionPositionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSectionPosition extends EditRecord
{
    protected static string $resource = SectionPositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
