<?php

namespace App\Filament\Customer\Widgets;

use App\Filament\Resources\SocialResource;
use Filament\Support\Colors\Color;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class SocialsWidget extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                SocialResource::getEloquentQuery()
            )
            ->columns([
                TextColumn::make('user.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Created by'),
                TextColumn::make('facebook')
                    ->searchable()
                    ->url(fn ($record) => 'https://www.facebook.com/'.$record->facebook)
                    ->color('primary')
                    ->label('Facebook')
                    ->icon('heroicon-o-user')
                    ->placeholder('N/A'),
                TextColumn::make('instagram')
                    ->searchable()
                    ->url(fn ($record) => 'https://www.instagram.com/'.$record->instagram)
                    ->color(Color::Amber)
                    ->label('Instagram')
                    ->icon('heroicon-o-user')
                    ->placeholder('N/A'),
                TextColumn::make('twitter')
                    ->searchable()
                    ->url(fn ($record) => 'https://www.twitter.com/'.$record->twitter)
                    ->color(Color::Sky)
                    ->label('Twitter')
                    ->icon('heroicon-o-user')
                    ->placeholder('N/A'),
                TextColumn::make('linkedin')
                    ->searchable()
                    ->url(fn ($record) => 'https://www.linkedin.com/in/'.$record->linkedin)
                    ->color(Color::Indigo)
                    ->label('LinkedIn')
                    ->icon('heroicon-o-user')
                    ->placeholder('N/A'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->paginated(false)
            ->searchable(false);
    }
}
