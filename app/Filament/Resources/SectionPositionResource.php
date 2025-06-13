<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionPositionResource\Pages;
use App\Models\SectionPosition;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SectionPositionResource extends Resource
{
    protected static ?string $model = SectionPosition::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-up-down';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $pluralModelLabel = 'Section Positions';

    protected static ?string $slug = 'section-positions';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->icon('heroicon-o-user')
                    ->heading('Created by')
                    ->description('Who created this section position')
                    ->columns(1)
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->default(fn(): int => auth()->id())
                            ->required()
                            ->helperText(str('👤 The **currently authenticated user** is automatically set as the creator of this section position.')->inlineMarkdown()->toHtmlString())
                            ->disabled()
                            ->dehydrated()
                            ->columnSpanFull()
                            ->prefixIcon('heroicon-s-user-circle'),
                    ]),

                Section::make()
                    ->icon('heroicon-o-arrow-path')
                    ->heading('Section Configuration')
                    ->description('Configure how this section appears on your public page')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('section_name')
                            ->options([
                                'display-socials' => 'Social Media',
                                'guest-login' => 'Login',
                                'display-guest-services' => 'Services',
                                'guest-shop-display' => 'Shop',
                                'display-guest-business-hours' => 'Business Hours',
                                'display-guest-gallery' => 'Gallery',
                            ])
                            ->required()
                            ->helperText(str('Select the section you want to position on your public page.')->inlineMarkdown()->toHtmlString()),

                        Forms\Components\TextInput::make('position')
                            ->numeric()
                            ->required()
                            ->default(0)
                            ->helperText(str('Enter the position number for this section. **Lower numbers appear first** on your page (e.g., position 1 is at the top).')->inlineMarkdown()->toHtmlString()),

                        Forms\Components\Toggle::make('is_visible')
                            ->required()
                            ->default(true)
                            ->helperText(str('Toggle to **show or hide** this section on your public page. When disabled, the section will not appear to visitors.')->inlineMarkdown()->toHtmlString()),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->description(str('## Section Positioning

**Section positioning** allows you to control the order in which sections appear on your public page.

* **Drag and drop** sections to easily reorder them
* Use the **position field** to set specific positions
* **Lower numbers** appear first on the page
* Toggle **visibility** to show/hide sections

Customize your public page layout without touching any code!')->markdown()->toHtmlString())
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Created by'),
                Tables\Columns\TextColumn::make('section_name')
                    ->searchable()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'display-socials' => 'Social Media',
                        'guest-login' => 'Login',
                        'display-guest-services' => 'Services',
                        'guest-shop-display' => 'Shop',
                        'display-guest-business-hours' => 'Business Hours',
                        'display-guest-gallery' => 'Gallery',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('position')
                    ->numeric()
                    ->sortable()
                    ->formatStateUsing(function (int $state): string {
                        return match ($state) {
                            1 => '1 - Top (First section)',
                            2 => '2 - Upper section',
                            3 => '3 - Middle-upper section',
                            4 => '4 - Middle-lower section',
                            5 => '5 - Lower section',
                            6 => '6 - Bottom (Last section)',
                            default => $state . ' - Custom position',
                        };
                    }),
                Tables\Columns\IconColumn::make('is_visible')
                    ->boolean(),
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
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver()
                    ->label('')
                    ->icon('heroicon-o-pencil-square')
                    ->tooltip('Edit section position'),
            ])
            ->reorderable('position')
            ->defaultSort('position');
    }

    public static function canCreate(): bool
    {
        return false;
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
            'index' => Pages\ListSectionPositions::route('/'),
            'create' => Pages\CreateSectionPosition::route('/create'),
//            'edit' => Pages\EditSectionPosition::route('/{record}/edit'),
        ];
    }
}
