<?php

namespace App\Filament\Resources;

use App\Enums\Visibility;
use App\Filament\Resources\PrivacyResource\Pages;
use App\Models\CRUD_settings;
use App\Models\Privacy;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class PrivacyResource extends Resource
{
    protected static ?string $model = Privacy::class;

    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';

    protected static ?string $label = 'Privacy';

    protected static ?string $pluralModelLabel = 'Privacy';

    protected static ?string $navigationGroup = 'Footer';

    protected static ?string $slug = 'privacy';

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
                    ->placeholder('Add you about information here'),
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
                    ->label('Privacy exists ?'),
                Tables\Columns\TextColumn::make('content')
                    ->html()
                    ->label('Privacy')
                    ->wrap()
                    ->limit(200),
            ])
            ->paginated(false)
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver()
                    ->label('')
                    ->tooltip('Edit'),
            ])
            ->paginated(false)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->visible(CRUD_settings::query()->value('can_delete_content'))
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrivacies::route('/'),
            'create' => Pages\CreatePrivacy::route('/create'),
        ];
    }

    public static function canCreate(): bool
    {
        $recordExists = Privacy::exists();

        return ! $recordExists;
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
