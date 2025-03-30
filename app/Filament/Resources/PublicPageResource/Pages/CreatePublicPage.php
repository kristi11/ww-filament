<?php

namespace App\Filament\Resources\PublicPageResource\Pages;

use App\Filament\Resources\PublicPageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePublicPage extends CreateRecord
{
    protected static string $resource = PublicPageResource::class;
}
