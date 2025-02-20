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
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    private const PERMISSIONS = [
        'create' => [
            'name' => 'can_create_content',
            'label' => 'Can create content',
        ],
        'edit' => [
            'name' => 'can_edit_content',
            'label' => 'Can edit content',
        ],
        'delete' => [
            'name' => 'can_delete_content',
            'label' => 'Can delete content',
        ],
    ];

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema(self::buildFormSchema());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(self::buildTableColumns())
            ->filters([])
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCRUDSettings::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return CRUD_settings::query()->doesntExist();
    }

    public static function canEdit(Model $record): bool
    {
        return true;
    }

    public static function canDelete(Model $record): bool
    {
        return true;
    }

    private static function buildFormSchema(): array
    {
        return array_map(
            fn (array $permission) => Toggle::make($permission['name'])
                ->label($permission['label'])
                ->default(true)
                ->columnSpan(1)
                ->helperText($permission['label']),
            self::PERMISSIONS
        );
    }

    private static function buildTableColumns(): array
    {
        return array_map(
            fn (array $permission) => Tables\Columns\IconColumn::make($permission['name'])
                ->boolean(),
            self::PERMISSIONS
        );
    }
}
