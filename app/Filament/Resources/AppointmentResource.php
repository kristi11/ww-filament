<?php

namespace App\Filament\Resources;

use App\Enums\AppointmentStatus;
use App\Filament\Resources\AppointmentResource\Pages;
use App\Models\Appointment;
use Exception;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationGroup = 'Business Information';

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $recordTitleAttribute = 'client_name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Appointment creator')
                    ->columns(1)
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->default(fn(): int => auth()->id())
                            ->required()
                            ->helperText(str('The name of the user that created the appointment.')->inlineMarkdown()->toHtmlString())
                            ->disabled()
                            ->dehydrated()
                            ->columnSpanFull()
                            ->prefixIcon('heroicon-s-user-circle'),
                    ]),
                Section::make('Appointment details')
                    ->columns(2)
                    ->schema([
                        Select::make('service_id')
                            ->relationship('service', 'name')
                            ->required()
                            ->helperText(str('This is the list of the service available.')->inlineMarkdown()->toHtmlString())
                            ->columnSpanFull()
                            ->live()
                            ->prefixIcon('heroicon-s-cog'),
                        Select::make('teamUser_id')
                            ->relationship('user', 'name', function ($query) {
                                return $query->whereHas('roles', function ($query) {
                                    $query->where('name', 'team_user');
                                });
                            })
                            ->default(null)
                            ->helperText(str('This is the list of the **team members** you can set an appointment with.')->inlineMarkdown()->toHtmlString())
                            ->columnSpanFull()
                            ->live()
                            ->placeholder('Select a team member')
                            ->label('Appointment with')
                            ->prefixIcon('heroicon-s-users'),
                        DatePicker::make('date')
                            ->required()
                            ->helperText(str('The date of the appointment.')->inlineMarkdown()->toHtmlString())
                            ->prefixIcon('heroicon-s-calendar'),
                        TimePicker::make('time')
                            ->required()
                            ->helperText(str('The time of the appointment.')->inlineMarkdown()->toHtmlString())
                            ->prefixIcon('heroicon-s-clock'),
                    ]),
                Section::make('Client details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('client_name')
                            ->label('Name')
                            ->default(fn(): string => auth()->user()->name)
                            ->required()
                            ->helperText(str('The name of the user that created the appointment.')->inlineMarkdown()->toHtmlString())
                            ->disabled()
                            ->dehydrated()
                            ->columnSpanFull()
                            ->prefixIcon('heroicon-s-user'),
                        TextInput::make('client_email')
                            ->label('Email')
                            ->email()
                            ->default(fn(): string => auth()->user()->email)
                            ->required()
                            ->helperText(str('The email of the user that created the appointment.')->inlineMarkdown()->toHtmlString())
                            ->disabled()
                            ->dehydrated()
                            ->columnSpanFull()
                            ->prefixIcon('heroicon-s-envelope'),
                        TextInput::make('client_phone')
                            ->label('Phone')
                            ->default(null)
                            ->tel()
                            ->prefixIcon('heroicon-s-phone')
                            ->placeholder('Add a phone number'),
                        TextInput::make('client_referer')
                            ->label('Referred by')
                            ->maxLength(255)
                            ->default(null)
                            ->prefixIcon('heroicon-s-link')
                            ->placeholder('Person that referred the client'),
                        RichEditor::make('notes')
                            ->label('Notes')
                            ->columnSpanFull()
                            ->default(null)
                            ->disableToolbarButtons(['attachFiles', 'codeBlock'])
                            ->placeholder('Anything else the client/admin would like to add'),
                        Select::make('status')
                            ->label('Appointment status')
                            ->enum(AppointmentStatus::class)
                            ->options(AppointmentStatus::class)
                            ->default('pending')
                            ->required()
                            ->columnSpanFull()
                            ->prefixIcon('heroicon-s-arrow-path'),
                    ]),
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
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable()
                    ->label('Created by')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('service.name')
                    ->searchable()
                    ->sortable()
                    ->label('Appointment name'),
                Tables\Columns\TextColumn::make('teamUser.name')
                    ->searchable()
                    ->sortable()
                    ->label('Appointment with')
                    ->placeholder('No team member selected')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('date')
                    ->searchable()
                    ->sortable()
                    ->label('Appointment date')
                    ->date(),
                Tables\Columns\TextColumn::make('time')
                    ->searchable()
                    ->time('h:i A')
                    ->sortable()
                    ->label('Appointment time'),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(function ($state) {
                        return AppointmentStatus::from($state)->getColor();
                    })
                    ->icon(function ($state) {
                        return AppointmentStatus::from($state)->getIcon();
                    })
                    ->label('Appointment status'),
                Tables\Columns\TextColumn::make('client_name')
                    ->searchable()
                    ->label('Client name')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('client_email')
                    ->searchable()
                    ->url(fn($record) => "mailto:$record->client_email")
                    ->color('primary')
                    ->label('Client email')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('client_phone')
                    ->searchable()
                    ->placeholder('No phone')
                    ->label('Client phone')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('notes')
                    ->searchable()
                    ->html()
                    ->limit(30)
                    ->placeholder('No notes')
                    ->label('Notes')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('client_referer')
                    ->searchable()
                    ->placeholder('No referer')
                    ->limit(30)
                    ->label('Referred by')
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Filters\SelectFilter::make('teamUser_id')
                    ->relationship('teamUser', 'name', function ($query) {
                        return $query->whereHas('roles', function ($query) {
                            $query->where('name', 'team_user');
                        });
                    })
                    ->label('Appointment with'),
                Tables\Filters\SelectFilter::make('service_id')
                    ->relationship('service', 'name')
                    ->label('Appointment name'),
            ])
            ->filtersFormColumns(2)
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver()
                    ->label('')
                    ->tooltip('Edit'),
            ])
            ->paginated(false)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([

                \Filament\Infolists\Components\Section::make('Client details')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('client_name')
                            ->label('Client name'),
                        TextEntry::make('client_email')
                            ->label('Client email')
                            ->url(fn($record) => "mailto:$record->client_email")
                            ->color('primary'),
                        TextEntry::make('client_phone')
                            ->label('Client phone')
                            ->placeholder('No phone'),
                        TextEntry::make('notes')
                            ->label('Notes')
                            ->html()
                            ->placeholder('No notes')
                            ->columnSpanFull(),
                    ]),

                \Filament\Infolists\Components\Section::make('Client referer')
                    ->columns(1)
                    ->schema([
                        TextEntry::make('client_referer')
                            ->label('Referred by')
                            ->placeholder('No referer'),
                    ]),

                \Filament\Infolists\Components\Section::make('Appointment details')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('user.name')
                            ->label('Created by'),
                        TextEntry::make('teamUser.name')
                            ->label('Appointment with')
                            ->placeholder('No team member selected'),
                        TextEntry::make('service.name')
                            ->label('Appointment name'),
                        TextEntry::make('date')
                            ->label('Appointment date')
                            ->date(),
                        TextEntry::make('time')
                            ->label('Appointment time')
                            ->time('h:i A'),
                        TextEntry::make('status')
                            ->label('Appointment status')
                            ->badge()
                            ->color(function ($state) {
                                return AppointmentStatus::from($state)->getColor();
                            })
                            ->icon(function ($state) {
                                return AppointmentStatus::from($state)->getIcon();
                            }),
                    ]),

                \Filament\Infolists\Components\Section::make('Timestamps')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Created at')
                            ->dateTime(format: 'M-d-Y H:i:A'),
                        TextEntry::make('updated_at')
                            ->label('Updated at')
                            ->dateTime(format: 'M-d-Y H:i:A'),
                    ]),
            ]);

    }

    public static function getNavigationBadge(): ?string
    {
        return Appointment::count();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
