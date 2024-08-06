<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionColorsResource\Pages;
use App\Models\SectionColors;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class SectionColorsResource extends Resource
{
    protected static ?string $model = SectionColors::class;

    protected static ?string $navigationIcon = 'heroicon-o-swatch';
    protected static ?string $label = 'Section Colors';
    protected static ?string $navigationGroup = 'Visuals';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('loginBackgroundColor')
                    ->helperText('This resource uses tailwind css colors. For example: bg-blue-500. You can find more colors at https://tailwindcss.com/docs/background-color if you need to change section colors.')
                    ->placeholder('No background color set')
                    ->maxLength(255),
                TextInput::make('servicesBackgroundColor')
                    ->helperText('This resource uses tailwind css colors. For example: bg-blue-500. You can find more colors at https://tailwindcss.com/docs/background-color if you need to change section colors.')
                    ->maxLength(255),
                TextInput::make('hoursBackgroundColor')
                    ->helperText('This resource uses tailwind css colors. For example: bg-blue-500. You can find more colors at https://tailwindcss.com/docs/background-color if you need to change section colors.')
                    ->maxLength(255),
                TextInput::make('galleryBackgroundColor')
                    ->helperText('This resource uses tailwind css colors. For example: bg-blue-500. You can find more colors at https://tailwindcss.com/docs/background-color if you need to change section colors.')
                    ->maxLength(255),
                TextInput::make('ctaBackgroundColor')
                    ->helperText('This resource uses tailwind css colors. For example: bg-blue-500. You can find more colors at https://tailwindcss.com/docs/background-color if you need to change section colors.')
                    ->maxLength(255),
                TextInput::make('footerBackgroundColor')
                    ->helperText('This resource uses tailwind css colors. For example: bg-blue-500. You can find more colors at https://tailwindcss.com/docs/background-color if you need to change section colors.')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('loginBackgroundColor')
                    ->searchable()
                    ->placeholder('No background color set'),
                TextColumn::make('servicesBackgroundColor')
                    ->searchable()
                    ->placeholder('No background color set'),
                TextColumn::make('hoursBackgroundColor')
                    ->searchable()
                    ->placeholder('No background color set'),
                TextColumn::make('galleryBackgroundColor')
                    ->searchable()
                    ->placeholder('No background color set'),
                TextColumn::make('ctaBackgroundColor')
                    ->searchable()
                    ->placeholder('No background color set'),
                TextColumn::make('footerBackgroundColor')
                    ->searchable()
                    ->placeholder('No background color set'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->slideOver(),
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
//            'create' => Pages\CreateSectionColors::route('/create'),
//            'edit' => Pages\EditSectionColors::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        $recordExists = SectionColors::exists();

        return ! $recordExists;
    }
    public static function canEdit(Model $record): bool
    {
        return false;
    }
    public static function canDelete(Model $record): bool
    {
        return false;
    }
}
