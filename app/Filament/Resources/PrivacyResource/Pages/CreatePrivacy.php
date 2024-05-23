<?php

namespace App\Filament\Resources\PrivacyResource\Pages;

use App\Filament\Resources\PrivacyResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePrivacy extends CreateRecord
{
    protected static string $resource = PrivacyResource::class;

    protected static bool $canCreateAnother = false;
}
