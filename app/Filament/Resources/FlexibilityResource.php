<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FlexibilityResource\Pages;
use App\Models\CRUD_settings;
use App\Models\Flexibility;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class FlexibilityResource extends Resource
{
    protected static ?string $model = Flexibility::class;

//    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static ?string $navigationGroup = 'Business Information';

    protected static ?string $pluralModelLabel = 'Flexibility';

    protected static ?string $slug = 'flexibility';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Created by')
                    ->columns(1)
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->default(fn(): int => auth()->id())
                            ->required()
                            ->helperText(str('The **currently authenticated user** is automatically set as the user.')->inlineMarkdown()->toHtmlString())
                            ->disabled()
                            ->dehydrated()
                            ->prefixIcon('heroicon-o-user-circle'),
                    ]),

                Section::make('Business Information')
                    ->columns(2)
                    ->schema([
                        Toggle::make('always_open')
                            ->required()
                            ->columnSpan(1),
                        Toggle::make('flexible_pricing')
                            ->required()
                            ->columnSpan(1),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Created by'),
                IconColumn::make('always_open')
                    ->boolean(),
                IconColumn::make('flexible_pricing')
                    ->boolean(),
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
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()
                    ->slideOver()
                    ->label('')
                    ->tooltip('Edit'),
            ])
            ->paginated(false)
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->visible(CRUD_settings::query()->value('can_delete_content'))
                        ->label('')
                        ->tooltip('Delete'),
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
            'index' => Pages\ListFlexibilities::route('/'),
            'create' => Pages\CreateFlexibility::route('/create'),
        ];
    }

    public static function canCreate(): bool
    {
        // Disable the "Create" button if a row already exists
        return Flexibility::query()->doesntExist();
    }

    public static function canEdit(Model $record): bool
    {
        return CRUD_settings::query()->value('can_edit_content');
    }

    public static function canDelete(Model $record): bool
    {
        return CRUD_settings::query()->value('can_delete_content');
    }
}
