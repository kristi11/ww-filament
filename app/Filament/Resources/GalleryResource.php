<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Models\Gallery;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Visuals';

    protected static ?string $pluralModelLabel = 'Gallery';

    protected static ?string $recordTitleAttribute = 'service.name';

    protected static ?string $slug = 'gallery';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Service Information')
                    ->schema([
                        Select::make('service_id')
                            ->relationship('service', 'name')
                            ->required(),
                    ]),
                Section::make('Editor Information')
                    ->schema([
                        RichEditor::make('description')
                            ->columnSpanFull()
                            ->helperText('The description of the service.')
                            ->disableToolbarButtons([
                                'attachFiles',
                            ]),
                    ]),
                Section::make('Image Information')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('image')
                            ->image()
                            ->imageEditor()
                            ->placeholder('Upload service images')
                            ->multiple()
                            ->disk('s3-public')
                            ->directory('gallery')
                            ->visibility('public')
                            ->reorderable(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('service.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Created by'),
                SpatieMediaLibraryImageColumn::make('image')
                    ->circular()
                    ->stacked()
                    ->limit(3),
                TextColumn::make('description')
                    ->searchable()
                    ->limit(30)
                    ->html()
                    ->wrap(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
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
//                    Tables\Actions\DeleteBulkAction::make()
//                          ->label('')
//                          ->tooltip('Delete'),
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
            'index' => Pages\ListGalleries::route('/'),
            //            'create' => Pages\CreateGallery::route('/create'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }
}
