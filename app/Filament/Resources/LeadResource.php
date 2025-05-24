<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeadResource\Pages;
use App\Models\Lead;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'Leads';
    protected static ?string $navigationGroup = 'Communication';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\Textarea::make('message')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('read')
                    ->default(false),
                Forms\Components\TextInput::make('status')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('message')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\IconColumn::make('read')
                    ->boolean(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->toggleable(),
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
                Tables\Filters\Filter::make('unread')
                    ->query(fn (Builder $query): Builder => $query->where('read', false)),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->slideOver()
                    ->before(function (Lead $record): void {
                        // Update the lead record when the slideover is opened for the first time
                        if (!$record->read) {
                            $record->update([
                                'read' => true,
                                'status' => 'seen',
                            ]);
                        }
                    })
                    ->infolist([
                        Section::make()
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Name'),
                                TextEntry::make('email')
                                    ->label('Email'),
                                TextEntry::make('phone')
                                    ->label('Phone'),
                                TextEntry::make('message')
                                    ->label('Message')
                                    ->columnSpanFull(),
                                TextEntry::make('status')
                                    ->label('Status'),
                                TextEntry::make('created_at')
                                    ->label('Submitted At')
                                    ->dateTime(),
                            ])
                            ->columns(2),
                    ])
                    ->extraModalFooterActions([
                        Tables\Actions\Action::make('reply_email')
                            ->label('Reply via Email')
                            ->icon('heroicon-o-paper-airplane')
                            ->color('primary')
                            ->form([
                                Forms\Components\TextInput::make('subject')
                                    ->label('Subject')
                                    ->required()
                                    ->default(fn (Lead $record) => "Re: Your inquiry - {$record->name}"),
                                Forms\Components\RichEditor::make('message')
                                    ->label('Message')
                                    ->required()
                                    ->default(fn (Lead $record) => "Dear {$record->name},<br><br>Thank you for your inquiry. "),
                            ])
                            ->action(function (array $data, Lead $record): void {
                                // Mark as read
                                $record->update([
                                    'read' => true,
                                ]);

                                // Send email
                                \Mail::to($record->email)
                                    ->send(new \App\Mail\LeadReply(
                                        $record,
                                        $data['subject'],
                                        $data['message']
                                    ));

                                // Show success notification
                                \Filament\Notifications\Notification::make()
                                    ->title('Email sent successfully')
                                    ->success()
                                    ->send();
                            }),
                    ]),
                Tables\Actions\Action::make('mark_as_read')
                    ->icon('heroicon-o-check')
                    ->action(fn (Lead $record) => $record->update(['read' => true]))
                    ->visible(fn (Lead $record) => !$record->read),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('mark_as_read')
                        ->icon('heroicon-o-check')
                        ->action(fn (Collection $records) => $records->each->update(['read' => true]))
                        ->deselectRecordsAfterCompletion(),
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
            'index' => Pages\ListLeads::route('/'),
            'create' => Pages\CreateLead::route('/create'),
        ];
    }
}
