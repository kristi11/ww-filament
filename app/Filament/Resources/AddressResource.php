<?php

namespace App\Filament\Resources;

use App\Enums\US_STATES;
use App\Filament\Resources\AddressRecourceResource\RelationManagers\AddressesRelationManager;
use App\Filament\Resources\AddressResource\Pages;
use App\Models\Address;
use App\Models\CRUD_settings;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class AddressResource extends Resource
{
    protected static ?string $model = Address::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static ?string $navigationGroup = 'Business Information';

    protected static ?string $pluralModelLabel = 'Address';

    protected static ?string $slug = 'address';

    protected static ?string $recordTitleAttribute = 'street';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Address user')
                    ->columns(1)
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->default(fn(): int => auth()->id())
                            ->required()
                            ->helperText(str('The **currently authenticated user** is automatically set as the user.')->inlineMarkdown()->toHtmlString())
                            ->disabled()
                            ->dehydrated()
                            ->columnSpanFull()
                            ->prefixIcon('heroicon-s-user-circle'),
                    ]),

                Section::make('Address Information')
                    ->columns(2)
                    ->schema([
                        TextInput::make('street')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Street name')
                            ->columnSpan(1)
                            ->prefixIcon('heroicon-s-home'),
                        TextInput::make('city')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('City')
                            ->columnSpan(1)
                            ->prefixIcon('heroicon-s-map-pin'),
                        Select::make('state')
                            ->options(US_STATES::class)
                            ->required()
                            ->searchable()
                            ->preload()
                            ->placeholder('State')
                            ->columnSpan(1)
                            ->prefixIcon('heroicon-s-map-pin'),
                        TextInput::make('zip')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Zip code')
                            ->columnSpan(1)
                            ->prefixIcon('heroicon-s-map-pin'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Created by'),
                Tables\Columns\TextColumn::make('street'),
                Tables\Columns\TextColumn::make('city'),
                Tables\Columns\TextColumn::make('state'),
                Tables\Columns\TextColumn::make('zip')
                    ->badge()
                    ->color(Color::Indigo),
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
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver()
                    ->label('')
                    ->tooltip('Edit'),
            ])
            ->paginated(false);
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'street' => $record->street,
            'city' => $record->city,
            'state' => $record->state,
            'zip' => $record->zip,
        ];
    }

    public static function getRelations(): array
    {
        return [
            AddressesRelationManager::class,
        ];
    }

    public static function canCreate(): bool
    {
        $recordExists = Address::exists();

        return !$recordExists;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAddresses::route('/'),
            'create' => Pages\CreateAddress::route('/create'),
            //            'edit' => Pages\EditAddress::route('/{record}/edit'),
        ];
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
