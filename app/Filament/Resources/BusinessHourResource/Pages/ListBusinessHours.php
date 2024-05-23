<?php

namespace App\Filament\Resources\BusinessHourResource\Pages;

use App\Filament\Resources\BusinessHourResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBusinessHours extends ListRecords
{
    protected static string $resource = BusinessHourResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
