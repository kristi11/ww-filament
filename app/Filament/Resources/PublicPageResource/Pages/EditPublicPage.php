<?php

namespace App\Filament\Resources\PublicPageResource\Pages;

use App\Filament\Resources\PublicPageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPublicPage extends EditRecord
{
    protected static string $resource = PublicPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
