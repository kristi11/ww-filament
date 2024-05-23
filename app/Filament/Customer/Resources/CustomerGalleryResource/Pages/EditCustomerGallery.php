<?php

namespace App\Filament\Customer\Resources\CustomerGalleryResource\Pages;

use App\Filament\Customer\Resources\CustomerGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomerGallery extends EditRecord
{
    protected static string $resource = CustomerGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
