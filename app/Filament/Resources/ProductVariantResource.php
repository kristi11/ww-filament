<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductVariantResource\Pages;
use App\Models\ProductVariant;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductVariantResource extends Resource
{
    protected static ?string $model = ProductVariant::class;

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'size';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema(ProductVariant::getForm());
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('product.image')
                    ->circular()
                    ->stacked()
                    ->ring(3)
                    ->disk(config('filesystems.disks.STORAGE_DISK'))
                    ->placeholder('No images')
                    ->limit(3)
                    ->limitedRemainingText(isSeparate: true)
                    ->checkFileExistence(false)
                ->label('Image'),
                Tables\Columns\TextColumn::make('product.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('color')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('size')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('age')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('pattern')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('weight')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('length')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('finish')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('corecount')
                    ->searchable()
                    ->placeholder('N/A')
                    ->label('Core Count'),
                Tables\Columns\TextColumn::make('graphiccardtype')
                    ->searchable()
                    ->placeholder('N/A')
                    ->label('Graphic Card Type'),
                Tables\Columns\TextColumn::make('memorysize')
                    ->searchable()
                    ->placeholder('N/A')
                    ->label('Memory Size'),
                Tables\Columns\TextColumn::make('dstorage')
                    ->searchable()
                    ->placeholder('N/A')
                    ->label('Digital Storage'),
                Tables\Columns\TextColumn::make('processortype')
                    ->searchable()
                    ->placeholder('N/A')
                    ->label('Processor Type'),
                Tables\Columns\TextColumn::make('enginevolume')
                    ->searchable()
                    ->placeholder('N/A')
                    ->label('Engine Volume'),
                Tables\Columns\TextColumn::make('material')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('memorysize')
                    ->searchable()
                    ->placeholder('N/A')
                    ->label('Memory Size'),
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
                Tables\Filters\SelectFilter::make('product')
                ->relationship('product', 'name')
                ->multiple()
                ->searchable()
                ->preload()
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->slideOver()
                ->label('')
                ->tooltip('Edit product variant'),
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
            'index' => Pages\ListProductVariants::route('/'),
//            'create' => Pages\CreateProductVariant::route('/create'),
//            'edit' => Pages\EditProductVariant::route('/{record}/edit'),
        ];
    }
}
