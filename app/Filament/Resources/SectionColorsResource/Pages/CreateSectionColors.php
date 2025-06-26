<?php

namespace App\Filament\Resources\SectionColorsResource\Pages;

use App\Filament\Resources\SectionColorsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSectionColors extends CreateRecord
{
    protected static string $resource = SectionColorsResource::class;

    protected static bool $canCreateAnother = false;
}
