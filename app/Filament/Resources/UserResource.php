<?php

namespace App\Filament\Resources;

use App\Enums\Visibility;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Exception;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Business Information';

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255),
                Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable(),
                //                DateTimePicker::make('email_verified_at'),
            ]);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->deferLoading()
            ->striped()
            ->columns([
//                ImageColumn::make('avatar_url')
//                    ->circular(),
                TextColumn::make('name')
                    ->searchable(),
                IconColumn::make('is_super_admin')
                    ->color(function ($state) {
                        return Visibility::from($state)->getVisibility();
                    })
                    ->boolean()
                    ->label('Super Admin'),
                IconColumn::make('is_team_user')
                    ->color(function ($state) {
                        return Visibility::from($state)->getVisibility();
                    })
                    ->boolean()
                    ->label('Team Member'),
                IconColumn::make('is_panel_user')
                    ->color(function ($state) {
                        return Visibility::from($state)->getVisibility();
                    })
                    ->boolean()
                    ->label('Customer'),
                TextColumn::make('email')
                    ->searchable()
                    ->badge()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->badge()
                    ->color('gray')
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
            ->filters([
                SelectFilter::make('roles')
                    ->relationship('roles', 'name')
                    ->getOptionLabelFromRecordUsing(function (Model $record) {
                        if ($record->name == 'panel_user') {
                            return 'Customers';
                        }

                        if ($record->name == 'team_user') {
                            return 'Team members';
                        }

                        return str_replace('_', ' ', ucwords($record->name, '_'));
                    }),
            ])
            ->actions([
                EditAction::make()
                    ->slideOver(),
            ])
            ->bulkActions([
//                BulkActionGroup::make([
//                    DeleteBulkAction::make(),
//                ]),
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
            'name' => $record->name,
            'email' => $record->email,
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return User::count();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            //            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
