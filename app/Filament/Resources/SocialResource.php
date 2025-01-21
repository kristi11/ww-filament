<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialResource\Pages;
use App\Models\CRUD_settings;
use App\Models\Social;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class SocialResource extends Resource
{
    protected static ?string $model = Social::class;
//    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Business Information';
    protected static ?string $recordTitleAttribute = 'user.name';

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
                Section::make('Social Media Links')
                    ->columns(2)
                    ->schema([
                        TextInput::make('facebook')
                            ->maxLength(255)
                            ->default(null)
                            ->prefix('https://www.facebook.com/'),
                        TextInput::make('instagram')
                            ->maxLength(255)
                            ->default(null)
                            ->prefix('https://www.instagram.com/'),
                        TextInput::make('twitter')
                            ->maxLength(255)
                            ->default(null)
                            ->prefix('https://www.twitter.com/'),
                        TextInput::make('linkedin')
                            ->maxLength(255)
                            ->default(null)
                            ->prefix('https://www.linkedin.com/in/')
                            ->nullable(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Created by'),
                TextColumn::make('facebook')
                    ->searchable(),
                TextColumn::make('instagram')
                    ->searchable(),
                TextColumn::make('twitter')
                    ->searchable(),
                TextColumn::make('linkedin')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->paginated(false)
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
                    DeleteBulkAction::make()
                        ->visible(CRUD_settings::query()->value('can_delete_content'))
                        ->label('')
                        ->tooltip('Delete'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'name' => $record->user->name,
            'facebook' => $record->facebook,
            'instagram' => $record->instagram,
            'twitter' => $record->twitter,
            'linkedin' => $record->linkedin,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSocials::route('/'),
            'create' => Pages\CreateSocial::route('/create'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return Social::count();
    }

    public static function canCreate(): bool
    {
        $recordExists = Social::exists();

        return !$recordExists;
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
