<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductVariantResource\Pages;
use App\Models\CRUD_settings;
use App\Models\ProductVariant;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductVariantResource extends Resource
{
    protected static ?string $model = ProductVariant::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'product.name';

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
                ImageColumn::make('product.image')
                    ->circular()
                    ->stacked()
                    ->ring(3)
                    ->disk(config('filesystems.disks.STORAGE_DISK'))
                    ->placeholder('No images')
                    ->limit(3)
                    ->limitedRemainingText(isSeparate: true)
                    ->checkFileExistence(false)
                    ->label('Image'),
                TextColumn::make('color')
                    ->searchable()
                    ->placeholder('N/A'),
                TextColumn::make('size')
                    ->searchable()
                    ->placeholder('N/A'),
                TextColumn::make('age')
                    ->searchable()
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('pattern')
                    ->searchable()
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('weight')
                    ->searchable()
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('length')
                    ->searchable()
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('finish')
                    ->searchable()
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('gender')
                    ->searchable()
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('corecount')
                    ->searchable()
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Core Count'),
                TextColumn::make('graphiccardtype')
                    ->searchable()
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Graphic Card Type'),
                TextColumn::make('memorysize')
                    ->searchable()
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Memory Size'),
                TextColumn::make('dstorage')
                    ->searchable()
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Digital Storage'),
                TextColumn::make('processortype')
                    ->searchable()
                    ->placeholder('N/A')
                    ->label('Processor Type')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('enginevolume')
                    ->searchable()
                    ->placeholder('N/A')
                    ->label('Engine Volume')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('material')
                    ->searchable()
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('memorysize')
                    ->searchable()
                    ->placeholder('N/A')
                    ->label('Memory Size')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('model_number')
                    ->searchable()
                    ->placeholder('N/A')
                    ->label('Model number')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('dimensions')
                    ->searchable()
                    ->placeholder('N/A')
                    ->label('Dimensions')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('operating_system')
                    ->searchable()
                    ->placeholder('N/A')
                    ->label('Operating system')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('battery_capacity')
                    ->searchable()
                    ->placeholder('N/A')
                    ->label('Battery capacity')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('screen_resolution')
                    ->searchable()
                    ->placeholder('N/A')
                    ->label('Screen resolution')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->columnToggleFormMaxHeight('350px')
            ->filters([
                Tables\Filters\SelectFilter::make('product')
                    ->relationship('product', 'name')
                    ->multiple()
                    ->searchable()
                    ->preload(),
            ])
            ->defaultGroup('product.name')
            ->groups(['size', 'age', 'weight'])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver()
                    ->label('')
                    ->tooltip('Edit product variant'),
            ])
            ->bulkActions([
                DeleteBulkAction::make()
                    ->visible(CRUD_settings::query()->value('can_delete_content'))
                    ->label('')
                    ->tooltip('Delete'),
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
