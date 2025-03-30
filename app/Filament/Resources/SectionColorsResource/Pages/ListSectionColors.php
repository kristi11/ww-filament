<?php

namespace App\Filament\Resources\SectionColorsResource\Pages;

use App\Filament\Resources\SectionColorsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSectionColors extends ListRecords
{
    protected static string $resource = SectionColorsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
