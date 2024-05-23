<?php

namespace App\Filament\Resources\FlexibilityResource\Pages;

use App\Filament\Resources\FlexibilityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFlexibility extends EditRecord
{
    protected static string $resource = FlexibilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
