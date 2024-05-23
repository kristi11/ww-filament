<?php

namespace App\Filament\Resources\HelpResource\Pages;

use App\Filament\Resources\HelpResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHelp extends CreateRecord
{
    protected static string $resource = HelpResource::class;

    protected static bool $canCreateAnother = false;
}
