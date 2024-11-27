<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers\VariantsRelationManager;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
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
                    ->prefixIcon('heroicon-o-user'),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefixIcon('heroicon-o-currency-dollar')
                    ->hint('Price should be inserted in cents. (Ex. $1 = 100)'),
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
                    ->color('primary'),
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
//                Tables\Actions\EditAction::make(),
//                Tables\Actions\ViewAction::make()
//                ->slideOver(),
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

//    public static function canCreate(): bool
//    {
//        return false;
//    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

//    public static function canDelete(Model $record): bool
//    {
//        return false;
//    }
}
