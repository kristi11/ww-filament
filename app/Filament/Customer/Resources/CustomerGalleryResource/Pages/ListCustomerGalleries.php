<?php

namespace App\Filament\Customer\Resources\CustomerGalleryResource\Pages;

use App\Filament\Customer\Resources\CustomerGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomerGalleries extends ListRecords
{
    protected static string $resource = CustomerGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
