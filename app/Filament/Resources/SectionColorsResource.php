<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionColorsResource\Pages;
use App\Filament\Resources\SectionColorsResource\RelationManagers;
use App\Models\SectionColors;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SectionColorsResource extends Resource
{
    protected static ?string $model = SectionColors::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('loginBackgroundColor')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('servicesBackgroundColor')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('hoursBackgroundColor')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('galleryBackgroundColor')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('ctaBackgroundColor')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('footerBackgroundColor')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('loginBackgroundColor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('servicesBackgroundColor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('hoursBackgroundColor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('galleryBackgroundColor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ctaBackgroundColor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('footerBackgroundColor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSectionColors::route('/'),
            'create' => Pages\CreateSectionColors::route('/create'),
            'edit' => Pages\EditSectionColors::route('/{record}/edit'),
        ];
    }
}
