<?php

namespace App\Filament\Resources;

use App\Enums\GradientTypes;
use App\Filament\Resources\HeroResource\Pages;
use App\Models\CRUD_settings;
use App\Models\Hero;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\ColorEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class HeroResource extends Resource
{
    protected static ?string $model = Hero::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $pluralModelLabel = 'Hero';

    protected static ?string $slug = 'hero';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('User Information')
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->default(fn (): int => auth()->id())
                            ->required()
                            ->helperText(str('The **currently authenticated user** is automatically set as the user.')->inlineMarkdown()->toHtmlString())
                            ->disabled()
                            ->dehydrated()
                            ->columnSpanFull()
                            ->prefixIcon('heroicon-s-user-circle'),
                    ]),
                Section::make('Hero quotes')
                    ->schema([
                        TextInput::make('mainQuote')
                            ->required()
                            ->maxLength(255)
                            ->prefixIcon('heroicon-s-document-text')
                            ->placeholder('Main quote of the hero'),
                        TextInput::make('secondaryQuote')
                            ->maxLength(255)
                            ->nullable()
                            ->prefixIcon('heroicon-s-document-text')
                            ->placeholder('Secondary quote of the hero'),
                        TextInput::make('thirdQuote')
                            ->maxLength(255)
                            ->nullable()
                            ->prefixIcon('heroicon-s-document-text')
                            ->placeholder('Third quote of the hero'),
                    ]),
                Section::make('Hero gradient')
                    ->columns(2)
                    ->schema([
                        Select::make('gradientType')
                            ->options(GradientTypes::gradientType())
                            ->placeholder('Select a gradient type')
                            ->columnSpanFull(),
                        TextInput::make('gradientDegree')
                            ->required()
                            ->numeric()
                            ->suffix('%')
                            ->placeholder('Gradient degree of the hero')
                            ->columnSpanFull(),
                        TextInput::make('gradientDegreeStart')
                            ->required()
                            ->maxLength(255)
                            ->numeric()
                            ->suffix('%')
                            ->placeholder('Start degree of the hero gradient')
                            ->columnSpan(1),
                        ColorPicker::make('gradientDegreeFirstColor')
                            ->required()
                            ->suffixIcon('heroicon-s-swatch')
                            ->placeholder('First color of the hero gradient')
                            ->columnSpan(1)
                            ->regex('/^#([a-f0-9]{6}|[a-f0-9]{3})\b$/'),
                        TextInput::make('gradientDegreeEnd')
                            ->required()
                            ->numeric()
                            ->suffix('%')
                            ->placeholder('End degree of the hero gradient')
                            ->columnSpan(1),
                        ColorPicker::make('gradientDegreeSecondColor')
                            ->required()
                            ->suffixIcon('heroicon-s-swatch')
                            ->placeholder('Second color of the hero gradient')
                            ->columnSpan(1)
                            ->regex('/^#([a-f0-9]{6}|[a-f0-9]{3})\b$/'),
                    ]),
                Section::make('Hero image')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->imageEditor()
                            ->placeholder('Upload hero image')
                            ->disk(config('filesystems.disks.STORAGE_DISK'))
                            ->directory('hero')
                            ->visibility('public'),
                    ]),

                Section::make('Hero waves')
                    ->schema([
                        Forms\Components\Toggle::make('waves')
                            ->required()
                            ->helperText('Enable or disable waves for the hero')
                            ->columnSpanFull(),
                    ]),
                Section::make('Full screen background image')
                    ->schema([
                        Forms\Components\Toggle::make('full_screen_image')
                            ->required()
                            ->helperText('Here you can choose whether you want the image as the hero background or have a gradient background with the option of adding an image')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Created by'),
                //                SpatieMediaLibraryImageColumn::make('image')
                //                    ->circular()
                //                    ->label('Hero image')
                //                    ->placeholder('No image'),
                ImageColumn::make('image')
                    ->circular()
                    ->label('Hero image')
                    ->placeholder('No image')
                    ->disk(config('filesystems.disks.STORAGE_DISK'))
                    ->extraImgAttributes(['loading' => 'lazy']),
                TextColumn::make('mainQuote')
                    ->limit(20)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('secondaryQuote')
                    ->limit(20)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('thirdQuote')
                    ->limit(20)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('gradientDegree')
                    ->numeric()
                    ->suffix('%')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('gradientDegreeStart')
                    ->numeric()
                    ->suffix('%')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('gradientDegreeEnd')
                    ->numeric()
                    ->suffix('%')
                    ->toggleable(isToggledHiddenByDefault: true),
                ColorColumn::make('gradientDegreeFirstColor')
                    ->copyable()
                    ->copyMessage('color code copied')
                    ->copyMessageDuration(1500)
                    ->tooltip('Click to copy color code'),
                ColorColumn::make('gradientDegreeSecondColor')
                    ->copyable()
                    ->copyMessage('color code copied')
                    ->copyMessageDuration(1500)
                    ->tooltip('Click to copy color code'),
                IconColumn::make('waves')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->paginated([10, 25, 50])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make()
                    ->slideOver()
                    ->label('')
                    ->tooltip('View details'),
                EditAction::make()
                    ->slideOver()
                    ->label('')
                    ->tooltip('Edit'),
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
                \Filament\Infolists\Components\Section::make('Hero image')
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
                \Filament\Infolists\Components\Section::make('Hero quotes')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('mainQuote')
                            ->limit(20),
                        TextEntry::make('secondaryQuote')
                            ->limit(20),
                        TextEntry::make('thirdQuote')
                            ->limit(20),
                    ]),
                \Filament\Infolists\Components\Section::make('Hero degrees')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('gradientDegree')
                            ->numeric()
                            ->suffix('%')
                            ->columnSpanFull(),
                        TextEntry::make('gradientDegreeStart')
                            ->numeric()
                            ->suffix('%'),
                        TextEntry::make('gradientDegreeEnd')
                            ->numeric()
                            ->suffix('%'),
                    ]),
                \Filament\Infolists\Components\Section::make('Hero colors')
                    ->columns(2)
                    ->schema([
                        ColorEntry::make('gradientDegreeFirstColor')
                            ->copyable()
                            ->copyMessage('color code copied')
                            ->copyMessageDuration(1500)
                            ->tooltip('Click to copy color code'),
                        ColorEntry::make('gradientDegreeSecondColor')
                            ->copyable()
                            ->copyMessage('color code copied')
                            ->copyMessageDuration(1500)
                            ->tooltip('Click to copy color code'),
                    ]),
                \Filament\Infolists\Components\Section::make('Hero waves')
                    ->schema([
                        IconEntry::make('waves')
                            ->boolean(),
                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHeroes::route('/'),
            'create' => Pages\CreateHero::route('/create'),
            //            'edit' => Pages\EditHero::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        $recordExists = Hero::exists();

        return ! $recordExists;
    }

    public static function canEdit(Model $record): bool
    {
        return cache()->remember('crud_settings_can_edit_content', now()->addMinutes(60), function () {
            return CRUD_settings::query()->value('can_edit_content');
        });
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }
}
