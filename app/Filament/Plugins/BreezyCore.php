<?php

namespace App\Filament\Plugins;

use Filament\Forms;

class BreezyCore extends \Jeffgreco13\FilamentBreezy\BreezyCore
{
    public function getAvatarUploadComponent()
    {
        $fileUpload = Forms\Components\FileUpload::make('avatar_url')
            ->disk('DO-SPACES')
            ->label(__('filament-breezy::default.fields.avatar'))
            ->avatar();

        return is_null($this->avatarUploadComponent) ? $fileUpload : $this->evaluate($this->avatarUploadComponent, namedInjections: [
            'fileUpload' => $fileUpload,
        ]);
    }
}
