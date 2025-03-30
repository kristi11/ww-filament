<?php

namespace App\Filament\Pages;

use Monzer\FilamentChatifyIntegration\Pages\Chatify as BaseChat;

class CustomChatifyPage extends BaseChat
{
    protected static ?string $slug = "chat";
    protected static ?string $navigationLabel = "Support";
    protected static ?string $title = "Support";
}
