<?php

namespace App\Filament\Resources;

use App\Enums\Visibility;
use App\Filament\Resources\SupportResource\Pages;
use App\Models\Support;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class SupportResource extends Resource
{
    protected static ?string $model = Support::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    protected static ?string $label = 'Support';

    protected static ?string $pluralModelLabel = 'Support';

    protected static ?string $navigationGroup = 'Footer';

    protected static ?string $slug = 'support';

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
                    ->placeholder('Add you support information here'),
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
                    ->label('Support exists ?'),
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
            'index' => Pages\ListSupports::route('/'),
            'create' => Pages\CreateSupport::route('/create'),
        ];
    }

    public static function canCreate(): bool
    {
        $recordExists = Support::exists();

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
