<?php

namespace App\Filament\Customer\Resources\CustomerGalleryResource\Pages;

use App\Filament\Customer\Resources\CustomerGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomerGallery extends CreateRecord
{
    protected static string $resource = CustomerGalleryResource::class;
}
