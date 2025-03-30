<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionColorsResource\Pages;
use App\Models\CRUD_settings;
use App\Models\SectionColors;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class SectionColorsResource extends Resource
{
    protected static ?string $model = SectionColors::class;

    protected static ?string $navigationIcon = 'heroicon-o-swatch';
    protected static ?string $label = 'Section color';
    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('User Information')
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->default(fn(): int => auth()->id())
                            ->required()
                            ->helperText(str('The **currently authenticated user** is automatically set as the user.')->inlineMarkdown()->toHtmlString())
                            ->disabled()
                            ->dehydrated()
                            ->columnSpanFull()
                            ->prefixIcon('heroicon-s-user-circle'),
                    ]),
                TextInput::make('loginBackgroundColor')
                    ->helperText('This resource uses tailwind css colors. For example: bg-blue-500. You can find more colors at https://tailwindcss.com/docs/background-color if you need to change section colors.')
                    ->placeholder('No background color set')
                    ->maxLength(255),
                TextInput::make('servicesBackgroundColor')
                    ->helperText('This resource uses tailwind css colors. For example: bg-blue-500. You can find more colors at https://tailwindcss.com/docs/background-color if you need to change section colors.')
                    ->maxLength(255),
                TextInput::make('hoursBackgroundColor')
                    ->helperText('This resource uses tailwind css colors. For example: bg-blue-500. You can find more colors at https://tailwindcss.com/docs/background-color if you need to change section colors.')
                    ->maxLength(255),
                TextInput::make('galleryBackgroundColor')
                    ->helperText('This resource uses tailwind css colors. For example: bg-blue-500. You can find more colors at https://tailwindcss.com/docs/background-color if you need to change section colors.')
                    ->maxLength(255),
                TextInput::make('ctaBackgroundColor')
                    ->helperText('This resource uses tailwind css colors. For example: bg-blue-500. You can find more colors at https://tailwindcss.com/docs/background-color if you need to change section colors.')
                    ->maxLength(255),
                TextInput::make('footerBackgroundColor')
                    ->helperText('This resource uses tailwind css colors. For example: bg-blue-500. You can find more colors at https://tailwindcss.com/docs/background-color if you need to change section colors.')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->description('Use Tailwind css class names to set the section colors')
            ->columns([
                TextColumn::make('loginBackgroundColor')
                    ->placeholder('No background color set'),
                TextColumn::make('servicesBackgroundColor')
                    ->placeholder('No background color set'),
                TextColumn::make('hoursBackgroundColor')
                    ->placeholder('No background color set'),
                TextColumn::make('galleryBackgroundColor')
                    ->placeholder('No background color set'),
                TextColumn::make('ctaBackgroundColor')
                    ->placeholder('No background color set'),
                TextColumn::make('footerBackgroundColor')
                    ->placeholder('No background color set'),
//                TextColumn::make('created_at')
//                    ->dateTime()
//                    ->sortable()
//                    ->toggleable(isToggledHiddenByDefault: true),
//                TextColumn::make('updated_at')
//                    ->dateTime()
//                    ->sortable()
//                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver()
                    ->label('')
                    ->tooltip('Edit'),
            ])
            ->paginated(false);
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
            'index' => Pages\ListSectionColors::route('/'),
//            'create' => Pages\CreateSectionColors::route('/create'),
//            'edit' => Pages\EditSectionColors::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        $recordExists = SectionColors::exists();

        return !$recordExists;
    }

    public static function canEdit(Model $record): bool
    {
        return CRUD_settings::query()->value('can_edit_content');
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }
}
