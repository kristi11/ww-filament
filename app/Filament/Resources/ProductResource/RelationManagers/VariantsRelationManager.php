<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use App\Models\ProductVariant;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class VariantsRelationManager extends RelationManager
{
    protected static string $relationship = 'variants';

    public function form(Form $form): Form
    {
        return $form
            ->schema(ProductVariant::getForm());
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('color')
            ->columns([
                Tables\Columns\TextColumn::make('color')
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('size')
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('age')
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('pattern')
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('weight')
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('length')
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('finish')
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('gender')
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('corecount')
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Core Count'),
                Tables\Columns\TextColumn::make('graphiccardtype')
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Graphic Card Type'),
                Tables\Columns\TextColumn::make('memorysize')
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Memory Size'),
                Tables\Columns\TextColumn::make('dstorage')
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Digital Storage'),
                Tables\Columns\TextColumn::make('processortype')
                    ->placeholder('N/A')
                    ->label('Processor Type')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('enginevolume')
                    ->placeholder('N/A')
                    ->label('Engine Volume')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('material')
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('memorysize')
                    ->placeholder('N/A')
                    ->label('Memory Size')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('model_number')
                    ->searchable()
                    ->placeholder('N/A')
                    ->label('Model number')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('dimensions')
                    ->searchable()
                    ->placeholder('N/A')
                    ->label('Dimensions')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('operating_system')
                    ->searchable()
                    ->placeholder('N/A')
                    ->label('Operating system')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('battery_capacity')
                    ->searchable()
                    ->placeholder('N/A')
                    ->label('Battery capacity')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('screen_resolution')
                    ->searchable()
                    ->placeholder('N/A')
                    ->label('Screen resolution')
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ->columnToggleFormMaxHeight('350px')
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver()
                    ->label('')
                    ->tooltip('Edit product variant'),
                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->tooltip('Delete product variant'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
