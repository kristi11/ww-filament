<?php

namespace App\Filament\Resources\FlexibilityResource\Pages;

use App\Filament\Resources\FlexibilityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFlexibilities extends ListRecords
{
    protected static string $resource = FlexibilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
