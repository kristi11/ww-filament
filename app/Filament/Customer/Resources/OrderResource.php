<?php

namespace App\Filament\Customer\Resources;

use App\Filament\Customer\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\TextInput::make('stripe_checkout_session_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('amount_shipping')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('amount_discount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('amount_tax')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('amount_subtotal')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('amount_total')
                    ->required()
                    ->numeric(),
                Forms\Components\Textarea::make('billing_address')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('shipping_address')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $userId = Auth::user()->id;
                $query->where('user_id', $userId);
            })
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->label('Order Nr')
                    ->prefix('#')
                    ->badge()
                    ->color(Color::Slate),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User name'),
                Tables\Columns\TextColumn::make('items.name')
                    ->sortable()
                    ->label("Item('s) name"),
                Tables\Columns\TextColumn::make('totalQuantity')
                    ->label('Total items ordered'),
                Tables\Columns\TextColumn::make('amount_shipping')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('amount_discount')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('amount_tax')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('amount_subtotal')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('amount_total')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Time ordered'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Time order updated'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('openLink')
                    ->label('')
                    ->tooltip('View order')
                    ->icon('heroicon-o-eye')
                    ->action(fn ($record) => null)
                    ->color('primary')
                    ->url(fn ($record) => route('view-order', ['orderId' => $record->id]))
                    ->openUrlInNewTab(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }


    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }
}
