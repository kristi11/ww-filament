<?php

namespace App\Filament\Resources\SocialResource\Pages;

use App\Filament\Resources\SocialResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSocial extends CreateRecord
{
    protected static string $resource = SocialResource::class;
    protected static bool $canCreateAnother = false;
}
