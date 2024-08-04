<?php

namespace App\Filament\Resources;

use App\Enums\HOURS;
use App\Enums\minutes;
use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Exception;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?string $navigationGroup = 'Business Information';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $slug = 'service';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Service Information')
                    ->columns(3)
                    ->schema(
                        [
                            Select::make('user_id')
                                ->relationship('user', 'name')
                                ->default(fn (): int => auth()->id())
                                ->required()
                                ->helperText(str('The **currently authenticated user** is automatically set as the user.')->inlineMarkdown()->toHtmlString())
                                ->disabled()
                                ->dehydrated()
                                ->columnSpan(1)
                                ->prefixIcon('heroicon-s-user-circle'),
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255)
                                ->columnSpan(1)
                                ->helperText('The name of the service.')
                                ->prefixIcon('heroicon-s-cube'),
                            TextInput::make('price')
                                ->maxLength(255)
                                ->numeric()
                                ->nullable()
                                ->columnSpan(1)
                                ->helperText('The price of the service.')
                                ->prefix('USD'),
                        ]

                    ),
                Section::make('Description')
                    ->columns(1)
                    ->schema(
                        [
                            RichEditor::make('description')
                                ->required()
                                ->columnSpanFull()
                                ->helperText('The description of the service.')
                                ->toolbarButtons([
                                    'blockquote',
                                    'bold',
                                    'bulletList',
                                    'codeBlock',
                                    'h2',
                                    'h3',
                                    'italic',
                                    'link',
                                    'orderedList',
                                    'redo',
                                    'strike',
                                    'underline',
                                    'undo',
                                ]),
                        ]
                    ),
                Section::make('Estimated Time')
                    ->columns(2)
                    ->schema(
                        [
                            Select::make('estimated_hours')
                                ->enum(HOURS::class)
                                ->options(HOURS::class)
                                ->searchable()
                                ->preload()
                                ->columnSpan(1)
                                ->helperText('The estimated hours of the service.')
                                ->nullable()
                                ->prefixIcon('heroicon-s-clock'),
                            Select::make('estimated_minutes')
                                ->enum(MINUTES::class)
                                ->options(MINUTES::class)
                                ->searchable()
                                ->preload()
                                ->columnSpan(1)
                                ->helperText('The estimated minutes of the service.')
                                ->nullable()
                                ->prefixIcon('heroicon-s-clock'),
                        ]
                    ),
                Section::make('Extra Description')
                    ->columns(1)
                    ->schema(
                        [
                            RichEditor::make('extra_description')
                                ->columnSpanFull()
                                ->helperText('The extra description of the service.')
                                ->toolbarButtons([
                                    'blockquote',
                                    'bold',
                                    'bulletList',
                                    'codeBlock',
                                    'h2',
                                    'h3',
                                    'italic',
                                    'link',
                                    'orderedList',
                                    'redo',
                                    'strike',
                                    'underline',
                                    'undo',
                                ]),
                        ]
                    ),
            ]);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Service name'),
                TextColumn::make('description')
                    ->searchable()
                    ->html()
                    ->limit(80)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('price')
                    ->searchable()
                    ->money()
                    ->sortable(),
                TextColumn::make('estimated_hours')
                    ->suffix(' hours')
                    ->searchable()
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('estimated_minutes')
                    ->suffix(' minutes')
                    ->searchable()
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('extra_description')
                    ->searchable()
                    ->html()
                    ->limit(20)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->searchable()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->searchable()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make()
                    ->slideOver()
                    ->label('View details'),
                EditAction::make()
                    ->slideOver(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                \Filament\Infolists\Components\Section::make('Service details')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('name')
                            ->label('Service name'),
                        TextEntry::make('price')
                            ->prefix('$')
                            ->label('Price'),
                        TextEntry::make('estimated_hours')
                            ->label('Estimated Hours')
                            ->suffix(' hours'),
                        TextEntry::make('estimated_minutes')
                            ->label('Estimated Minutes')
                            ->suffix(' minutes'),
                        TextEntry::make('description')
                            ->label('Description'),
                        TextEntry::make('extra_description')
                            ->label('Extra Description'),
                    ]),
            ]);

    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'name' => $record->name,
            'price' => $record->price,
            'estimated_hours' => $record->estimated_hours,
            'estimated_minutes' => $record->estimated_minutes,
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return Service::count();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            //            'create' => Pages\CreateService::route('/create'),
            //            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
