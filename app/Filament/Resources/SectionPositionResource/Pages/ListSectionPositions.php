<?php

namespace App\Filament\Resources\SectionPositionResource\Pages;

use App\Filament\Resources\SectionPositionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSectionPositions extends ListRecords
{
    protected static string $resource = SectionPositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
