<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TermsResource\Pages;
use App\Models\Terms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class TermsResource extends Resource
{
    protected static ?string $model = Terms::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $label = 'Terms';

    protected static ?string $pluralModelLabel = 'Terms';

    protected static ?string $navigationGroup = 'Footer';

    protected static ?string $slug = 'terms';

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
                RichEditor::make('content')
                    ->label('content')
                    ->columnSpanFull()
                    ->default(null)
                    ->disableToolbarButtons(['attachFiles', 'codeBlock'])
                    ->placeholder('Add you terms here'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('content')
                    ->html()
                    ->label('Support')
                    ->wrap()
                    ->limit(200),
            ])
            ->paginated(false)
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListTerms::route('/'),
            'create' => Pages\CreateTerms::route('/create'),
        ];
    }

    public static function canCreate(): bool
    {
        $recordExists = Terms::exists();

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
