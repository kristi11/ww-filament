<?php

namespace App\Filament\Resources\SupportResource\Pages;

use App\Filament\Resources\SupportResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSupport extends CreateRecord
{
    protected static string $resource = SupportResource::class;

    protected static bool $canCreateAnother = false;
}
