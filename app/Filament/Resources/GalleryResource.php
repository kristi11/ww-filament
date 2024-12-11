<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Models\CRUD_settings;
use App\Models\Gallery;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
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
                        FileUpload::make('image')
                            ->image()
                            ->imageEditor()
                            ->placeholder('Upload service images')
                            ->multiple()
                            ->disk(config('filesystems.disks.STORAGE_DISK'))
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
                ImageColumn::make('image')
                    ->disk(config('filesystems.disks.STORAGE_DISK'))
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
            ->emptyStateHeading('No images yet')
            ->emptyStateDescription('Try adding a few images to your gallery')
            ->emptyStateIcon('heroicon-o-rectangle-stack')
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
