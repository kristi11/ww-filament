<?php

namespace App\Models;

use App\Enums\AppointmentStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed $teamUser
 * @property mixed $service_id
 * @property mixed $services
 * @property mixed $teamUser_id
 */
class Appointment extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'service_id' => 'integer',
        'teamUser_id' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function teamUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teamUser_id');
    }

    public function getForm(): void
    {
        Section::make('Appointment creator')
            ->columns(1)
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
            ]);
        Section::make('Appointment details')
            ->columns(2)
            ->schema([
                Select::make('service_id')
                    ->relationship('services', 'name')
                    ->required()
                    ->helperText(str('This is the list of the **services available** you can set an appointment on.')->inlineMarkdown()->toHtmlString())
                    ->columnSpanFull()
                    ->live()
                    ->prefixIcon('heroicon-s-cog'),
                Select::make('teamUser_id')
                    ->relationship('user', 'name', function ($query) {
                        return $query->whereHas('roles', function ($query) {
                            $query->where('name', 'team_user');
                        });
                    })
                    ->required()
                    ->helperText(str('This is the list of the **team members** you can set an appointment with.')->inlineMarkdown()->toHtmlString())
                    ->columnSpanFull()
                    ->live()
                    ->prefixIcon('heroicon-s-users'),
                DatePicker::make('date')
                    ->required()
                    ->helperText(str('The date of the appointment.')->inlineMarkdown()->toHtmlString())
                    ->prefixIcon('heroicon-s-calendar'),
                TimePicker::make('time')
                    ->required()
                    ->helperText(str('The time of the appointment.')->inlineMarkdown()->toHtmlString())
                    ->prefixIcon('heroicon-s-clock'),
            ]);
        Section::make('Client details')
            ->columns(2)
            ->schema([
                TextInput::make('client_name')
                    ->label('Name')
                    ->default(fn (): string => auth()->user()->name)
                    ->required()
                    ->helperText(str('The name of the **currently authenticated user** is automatically set as the client name.')->inlineMarkdown()->toHtmlString())
                    ->disabled()
                    ->dehydrated()
                    ->columnSpanFull()
                    ->prefixIcon('heroicon-s-user'),
                TextInput::make('client_email')
                    ->label('Email')
                    ->email()
                    ->default(fn (): string => auth()->user()->email)
                    ->required()
                    ->helperText(str('The email of the **currently authenticated user** is automatically set as the client email.')->inlineMarkdown()->toHtmlString())
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
                    ->placeholder('Who referred you to us?'),
                RichEditor::make('notes')
                    ->label('Notes')
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->default(null)
                    ->disableToolbarButtons(['attachFiles', 'codeBlock'])
                    ->placeholder('Anything else you would like to add?'),
                Select::make('status')
                    ->label('Appointment status')
                    ->enum(AppointmentStatus::class)
                    ->options(AppointmentStatus::class)
                    ->default('pending')
                    ->required()
                    ->disabled()
                    ->dehydrated()
                    ->columnSpanFull()
                    ->helperText(str('The status of the appointment can only be changed by the administrator')->inlineMarkdown()->toHtmlString())
                    ->prefixIcon('heroicon-s-arrow-path'),
            ]);
    }
}
