<?php

namespace App\Filament\Resources\PublicPageResource\Pages;

use App\Filament\Resources\PublicPageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPublicPages extends ListRecords
{
    protected static string $resource = PublicPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
