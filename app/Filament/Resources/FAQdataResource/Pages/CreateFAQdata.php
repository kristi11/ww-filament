<?php

namespace App\Filament\Resources\FAQdataResource\Pages;

use App\Filament\Resources\FAQdataResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFAQdata extends CreateRecord
{
    protected static string $resource = FAQdataResource::class;

    protected static bool $canCreateAnother = false;
}
