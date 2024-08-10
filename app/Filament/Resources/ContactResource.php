<?php

namespace App\Filament\Resources;

use App\Enums\Visibility;
use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left';

    protected static ?string $navigationGroup = 'Footer';

    protected static ?string $label = 'Contact';

    protected static ?string $pluralModelLabel = 'Contact';

    protected static ?string $slug = 'contact';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->default(fn (): int => auth()->id())
                    ->required()
                    ->columnSpanFull()
                    ->helperText(str('The **currently authenticated user** is automatically set as the user.')->inlineMarkdown()->toHtmlString())
                    ->disabled()
                    ->dehydrated()
                    ->prefixIcon('heroicon-o-user-circle'),
                Toggle::make('visibility'),
                RichEditor::make('content')
                    ->label('content')
                    ->columnSpanFull()
                    ->default(null)
                    ->disableToolbarButtons(['attachFiles', 'codeBlock'])
                    ->placeholder('Add you contact information here'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('visibility')
                    ->color(function ($state) {
                        return Visibility::from($state)->getVisibility();
                    })
                    ->boolean()
                    ->label('Contact us exists ?'),
                Tables\Columns\TextColumn::make('content')
                    ->html()
                    ->label('Contact')
                    ->wrap()
                    ->limit(200),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver(),
            ])
            ->paginated(false)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
        ];
    }

    public static function canCreate(): bool
    {
        $recordExists = Contact::exists();

        return ! $recordExists;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }
}
