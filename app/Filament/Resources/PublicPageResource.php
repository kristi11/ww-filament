<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PublicPageResource\Pages;
use App\Models\PublicPage;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class PublicPageResource extends Resource
{
    protected static ?string $model = PublicPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';

    protected static ?string $navigationGroup = 'Visuals';

    protected static ?string $pluralModelLabel = 'Section visibility';

    protected static ?string $slug = 'public-page';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Created by')
                    ->columns(1)
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

                Section::make('Public Page Information')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Toggle::make('hero')
                            ->required()
                            ->helperText('Enable/Disable the hero section on the public page.'),
                        Forms\Components\Toggle::make('credentials')
                            ->required()
                            ->helperText('Enable/Disable the login section on the public page.'),
                        Forms\Components\Toggle::make('services')
                            ->required()
                            ->helperText('Enable/Disable the services section on the public page.'),
                        Forms\Components\Toggle::make('hours')
                            ->required()
                            ->helperText('Enable/Disable the business hours section on the public page.'),
                        Forms\Components\Toggle::make('gallery')
                            ->required()
                            ->helperText('Enable/Disable the gallery section on the public page.'),
                        Forms\Components\Toggle::make('email')
                            ->required()
                            ->helperText('Enable/Disable the Contact Us section on the public page.'),
                        Forms\Components\Toggle::make('footer')
                            ->required()
                            ->helperText('Enable/Disable the footer section on the public page.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Created by'),
                Tables\Columns\IconColumn::make('hero')
                    ->boolean(),
                Tables\Columns\IconColumn::make('credentials')
                    ->boolean(),
                Tables\Columns\IconColumn::make('services')
                    ->boolean(),
                Tables\Columns\IconColumn::make('hours')
                    ->boolean(),
                Tables\Columns\IconColumn::make('gallery')
                    ->boolean(),
                Tables\Columns\IconColumn::make('email')
                    ->boolean(),
                Tables\Columns\IconColumn::make('footer')
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
            ->paginated(false)
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver()
                    ->label('')
                    ->tooltip('Edit'),
            ])
            ->paginated(false)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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
            'index' => Pages\ListPublicPages::route('/'),
//            'create' => Pages\CreatePublicPage::route('/create'),
//            'edit' => Pages\EditPublicPage::route('/{record}/edit'),
        ];
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canCreate(): bool
    {
        $recordExists = PublicPage::exists();

        return !$recordExists;
    }
}
