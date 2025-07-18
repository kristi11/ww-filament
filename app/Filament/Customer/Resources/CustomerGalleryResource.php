<?php

namespace App\Filament\Customer\Resources;

use App\Filament\Customer\Resources\CustomerGalleryResource\Pages;
use App\Filament\Resources\GalleryResource;
use App\Models\Gallery;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CustomerGalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $pluralModelLabel = 'Gallery';

    protected static ?string $slug = 'service-images';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->contentGrid([
                'md' => 2,
                'xl' => 2,
            ])
            ->query(
                GalleryResource::getEloquentQuery()
            )
            ->columns([
                Split::make([
                    TextColumn::make('service.name')
                        ->numeric()
                        ->icon('heroicon-o-cog')
                        ->tooltip('name')
                        ->searchable(),
                    ImageColumn::make('image')
                        ->placeholder('Service image')
                        ->disk(config('filesystems.disks.STORAGE_DISK'))
                        ->visibility('public')
                        ->circular()
                        ->stacked()
                        ->limit(2)
                        ->limitedRemainingText(isSeparate: true),
                ]),
                Panel::make([
                    TextColumn::make('description')
                        ->searchable()
                        ->html(),
                ])
                    ->columnSpan(2)
                    ->collapsible(),
            ])
            ->filters([
                SelectFilter::make('author')->relationship('service', 'name'),
            ])
            ->emptyStateHeading('No images yet')
            ->emptyStateDescription('No images have been added to the gallery yet')
            ->emptyStateIcon('heroicon-o-rectangle-stack')
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('View service images')
                    ->icon('heroicon-o-eye')
                    ->color(Color::Indigo)
                    ->slideOver(),
            ]);
        //            ->bulkActions([
        //                Tables\Actions\BulkActionGroup::make([
        //                    Tables\Actions\DeleteBulkAction::make()
        //                      ->label('')
        //                      ->tooltip('Delete'),
        //                ]),
        //            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Images')
                    ->schema([
                        ImageEntry::make('image')
                            ->disk(config('filesystems.disks.STORAGE_DISK'))
                            ->visibility('public')
                            ->extraImgAttributes([
                                'class' => 'rounded-lg',
                                'loading' => 'lazy',
                                'style' => 'object-fit: cover; object-position: center;
                                width: 100%; height: 100%;
                                transition: transform 0.2s ease-in-out; transition: filter 0.2s ease-in-out;
                                ',
                            ])
                            ->label(''),
                    ])
                    ->columns(1)
                    ->columnSpanFull(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomerGalleries::route('/'),
            //            'view' => Pages\CustomerGalleryDisplay::route('/{record}'),
        ];
    }
}
