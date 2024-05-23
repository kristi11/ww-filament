<?php

namespace App\Filament\Resources\TermsResource\Pages;

use App\Filament\Resources\TermsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTerms extends ListRecords
{
    protected static string $resource = TermsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
