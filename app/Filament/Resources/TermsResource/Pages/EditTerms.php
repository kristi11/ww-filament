<?php

namespace App\Filament\Resources\TermsResource\Pages;

use App\Filament\Resources\TermsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTerms extends EditRecord
{
    protected static string $resource = TermsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
