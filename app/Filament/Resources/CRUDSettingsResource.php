<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CRUDSettingsResource\Pages;
use App\Models\CRUD_settings;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class CRUDSettingsResource extends Resource
{
    protected static ?string $model = CRUD_settings::class;

    protected static ?string $pluralModelLabel = 'Content';

    protected static ?string $slug = 'content';

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Toggle::make('can_create_content')
                ->label('Can create content')
                ->default(true)
                ->columnSpan(1)
                ->helperText('Can create content'),
                Toggle::make('can_edit_content')
                ->label('Can edit content')
                ->default(true)
                ->columnSpan(1)
                ->helperText('Can edit content'),
                Toggle::make('can_delete_content')
                ->label('Can delete content')
                ->default(true)
                ->columnSpan(1)
                ->helperText('Can delete content'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('can_create_content')
                    ->boolean(),
                Tables\Columns\IconColumn::make('can_edit_content')
                    ->boolean(),
                Tables\Columns\IconColumn::make('can_delete_content')
                    ->boolean()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->slideOver()
                ->label('')
                ->tooltip('Edit'),
            ])
            ->paginated(false);
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
            'index' => Pages\ListCRUDSettings::route('/'),
//            'create' => Pages\CreateCRUDSettings::route('/create'),
//            'edit' => Pages\EditCRUDSettings::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        // Disable the "Create" button if a row already exists
        return CRUD_settings::query()->doesntExist();
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
