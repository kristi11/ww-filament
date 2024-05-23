<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Models\About;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static ?string $navigationGroup = 'Footer';

    protected static ?string $label = 'About';

    protected static ?string $pluralModelLabel = 'About';

    protected static ?string $slug = 'about';

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
                    ->placeholder('Add you about information here'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('content')
                    ->html()
                    ->label('About')
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
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
        ];
    }

    public static function canCreate(): bool
    {
        $recordExists = About::exists();

        return ! $recordExists;
    }
}
