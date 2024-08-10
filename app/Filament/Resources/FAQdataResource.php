<?php

namespace App\Filament\Resources;

use App\Enums\Visibility;
use App\Filament\Resources\FAQdataResource\Pages;
use App\Models\FAQdata;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class FAQdataResource extends Resource
{
    protected static ?string $model = FAQdata::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $label = 'FAQ';

    protected static ?string $pluralModelLabel = 'FAQ';

    protected static ?string $navigationGroup = 'Footer';

    protected static ?string $slug = 'faq';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('FAQ')
                    ->columns(1)
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
                            ->placeholder('Add you FAQ here'),
                    ]),
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
                ->label('FAQ exists ?'),
                Tables\Columns\TextColumn::make('content')
                    ->html()
                    ->label('FAQ')
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
            'index' => Pages\ListFAQdatas::route('/'),
            'create' => Pages\CreateFAQdata::route('/create'),
        ];
    }

    public static function canCreate(): bool
    {
        $recordExists = FAQdata::exists();

        return ! $recordExists;
    }

//    public static function canDelete(Model $record): bool
//    {
//        return false;
//    }
//
//    public static function canEdit(Model $record): bool
//    {
//        return false;
//    }
}
