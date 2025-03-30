<?php

namespace App\Filament\Resources\TermsResource\Pages;

use App\Filament\Resources\TermsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTerms extends CreateRecord
{
    protected static string $resource = TermsResource::class;

    protected static bool $canCreateAnother = false;
}
