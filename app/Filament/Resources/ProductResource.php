<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers\VariantsRelationManager;
use App\Models\CRUD_settings;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->prefixIcon('heroicon-o-user')
                    ->hint('
            What will you name your product. Maybe choose a catchy name that would appeal to the customer'),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->step(0.01) // Allow 2 decimal places for cents
                    ->prefixIcon('heroicon-o-currency-dollar')
                    ->hint('Price should be inserted in dollars with up to two decimal places for cents. (Ex. $1.99 = 1.99)'),
                RichEditor::make('description')
                    ->required()
                    ->columnSpanFull()
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
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->imageEditor()
                    ->multiple()
                    ->disk(config('filesystems.disks.STORAGE_DISK'))
                    ->directory('shop')
                    ->reorderable()
                    ->openable()
                    ->panelLayout('grid')
                    ->appendFiles()
                    ->columnSpanFull()
                    ->visibility('public')
                    ->label('Product images'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->circular()
                    ->stacked()
                    ->ring(3)
                    ->disk(config('filesystems.disks.STORAGE_DISK'))
                    ->placeholder('No images')
                    ->limit(3)
                    ->limitedRemainingText(isSeparate: true)
                    ->checkFileExistence(false),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->html()
                    ->toggleable(isToggledHiddenByDefault: true)
                ->wrap(),
                Tables\Columns\TextColumn::make('price')
                    ->sortable()
                    ->badge()
                    ->color('primary')
                    ->prefix('$'),
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
            ->searchable()
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->slideOver()
                    ->label('')
                    ->tooltip('View details'),
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->tooltip('Edit product'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                    ->visible(CRUD_settings::query()->value('can_delete_content')),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                \Filament\Infolists\Components\Section::make("Product images")
                    ->columns(1)
                    ->schema([
                        ImageEntry::make('image')
                            ->disk(config('filesystems.disks.STORAGE_DISK'))
                            ->placeholder('No image')
                            ->columnSpanFull()
                            ->extraImgAttributes([
                                'class' => 'rounded-lg',
                                'loading' => 'lazy',
                                'style' => 'object-fit: cover; object-position: center;
                                width: 100%; height: 100%;
                                transition: transform 0.2s ease-in-out; transition: filter 0.2s ease-in-out;
                                ',
                            ]),
                    ]),
                TextEntry::make('name')
                    ->label('Product Name'),

                TextEntry::make('price')
                    ->label('Product Price')
                    ->prefix('$'),

                TextEntry::make('description')
                    ->label('Product Description')
                    ->html()
                ->columnSpanFull(),
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return Product::count();
    }

    public static function getRelations(): array
    {
        return [
            VariantsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
//            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return CRUD_settings::query()->value('can_create_content');
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
