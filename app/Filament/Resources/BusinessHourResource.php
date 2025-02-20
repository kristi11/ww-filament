<?php

namespace App\Filament\Resources;

use App\Enums\Day_status;
use App\Enums\Days;
use App\Filament\Resources\BusinessHourResource\Pages;
use App\Filament\Resources\BusinessRecourceResource\RelationManagers\BusinessHoursRelationManager;
use App\Models\BusinessHour;
use App\Models\CRUD_settings;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class BusinessHourResource extends Resource
{
    protected static ?string $model = BusinessHour::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Business Information';

    protected static ?string $recordTitleAttribute = 'day';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Business Status')
                    ->columns(2)
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->default(fn(): int => auth()->id())
                            ->required()
                            ->helperText(str('The **currently authenticated user** is automatically set as the user.')->inlineMarkdown()->toHtmlString())
                            ->disabled()
                            ->dehydrated()
                            ->prefixIcon('heroicon-o-user-circle'),
                        Select::make('status')
                            ->options(Day_status::class)
                            ->helperText('If the business is open on this day, select "Open". If the business is closed on this day, select "Closed".')
                            ->live()
                            ->prefixIcon('heroicon-o-arrow-path'),
                    ]),

                Section::make('Business Hours')
                    ->columns(3)
                    ->schema([
                        Select::make('day')
                            ->requiredIf('status', true)
                            ->enum(Days::class)
                            ->options(Days::class)
                            ->markAsRequired()
                            ->searchable()
                            ->preload()
                            ->unique()
                            ->helperText('Select the day of the week.')
                            ->prefixIcon('heroicon-o-calendar'),
                        TimePicker::make('open')
                            ->default('closed')
                            ->requiredIf('status', true)
                            ->markAsRequired()
                            ->disabled(fn(Forms\Get $get): bool => !$get('status'))
                            ->helperText('Select the time the business opens on this day.')
                            ->format('h:i A')
                            ->prefixIcon('heroicon-s-lock-open')
                            ->nullable(),
                        TimePicker::make('close')
                            ->default('closed')
                            ->requiredIf('status', true)
                            ->markAsRequired()
                            ->disabled(fn(Forms\Get $get): bool => !$get('status'))
                            ->helperText('Select the time the business closes on this day.')
                            ->format('h:i A')
                            ->prefixIcon('heroicon-s-lock-closed')
                            ->nullable(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->deferLoading()
            ->striped()
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Created by'),
                Tables\Columns\TextColumn::make('day')
                    ->searchable(),
                Tables\Columns\TextColumn::make('open')
                    ->searchable()
                    ->time(format: 'h:i A')
                    ->placeholder('Closed')
                    ->badge(),
                Tables\Columns\TextColumn::make('close')
                    ->searchable()
                    ->time(format: 'h:i A')
                    ->placeholder('Closed')
                    ->badge(),
                Tables\Columns\IconColumn::make('status')
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
            ->paginated(false)
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->slideOver()
                    ->label('')
                    ->tooltip('View'),
                Tables\Actions\EditAction::make()
                    ->slideOver()
                    ->label('')
                    ->tooltip('Edit'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(CRUD_settings::query()->value('can_delete_content'))
                        ->label('')
                        ->tooltip('Delete'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            BusinessHoursRelationManager::class,
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([

                \Filament\Infolists\Components\Section::make('Business day details')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('day')
                            ->label('Day')
                            ->badge()
                            ->color('primary'),
                        IconEntry::make('status')
                            ->label('Status'),
                        TextEntry::make('open')
                            ->label('Opens at')
                            ->time('h:i A')
                            ->placeholder('Closed')
                            ->badge(),
                        TextEntry::make('close')
                            ->label('Closes at')
                            ->time('h:i A')
                            ->placeholder('Closed')
                            ->badge(),
                    ]),
            ]);

    }

    public static function getNavigationBadge(): ?string
    {
        return BusinessHour::count();
    }

    public static function getGlobalSearchResultDetails($record): array
    {
        return [
            'day' => $record->day,
            'status' => $record->status ? 'Open' : 'Closed',
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBusinessHours::route('/'),
            //            'create' => Pages\CreateBusinessHour::route('/create'),
            //            'edit' => Pages\EditBusinessHour::route('/{record}/edit'),
        ];
    }

    public static function canCreate(int $limit = 7): bool
    {
        if (BusinessHour::count() >= $limit) {
            return false;
        }
        return true;
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
