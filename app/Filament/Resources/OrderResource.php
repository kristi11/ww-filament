<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path-rounded-square';

    protected static ?string $navigationGroup = 'Shop';

    //    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    //    public static function form(Form $form): Form
    //    {
    //        return $form
    //            ->schema([
    //                Forms\Components\Select::make('user_id')
    //                    ->relationship('user', 'name')
    //                    ->required(),
    //                Forms\Components\TextInput::make('stripe_checkout_session_id')
    //                    ->required()
    //                    ->maxLength(255),
    //                Forms\Components\TextInput::make('amount_shipping')
    //                    ->required()
    //                ,
    //                Forms\Components\TextInput::make('amount_discount')
    //                    ->required()
    //                ,
    //                Forms\Components\TextInput::make('amount_tax')
    //                    ->required()
    //                ,
    //                Forms\Components\TextInput::make('amount_subtotal')
    //                    ->required()
    //                ,
    //                Forms\Components\TextInput::make('amount_total')
    //                    ->required()
    //                ,
    //                Forms\Components\Textarea::make('billing_address')
    //                    ->required()
    //                    ->columnSpanFull(),
    //                Forms\Components\Textarea::make('shipping_address')
    //                    ->required()
    //                    ->columnSpanFull(),
    //            ]);
    //    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->label('Order Nr')
                    ->prefix('#')
                    ->badge()
                    ->color(Color::Slate),
                Tables\Columns\TextColumn::make('items.name')
                    ->label("Item('s) name"),
                Tables\Columns\TextColumn::make('totalQuantity')
                    ->badge()
                    ->color(Color::Indigo)
                    ->label('Total items ordered'),
                Tables\Columns\TextColumn::make('amount_shipping')
                    ->sortable()
                    ->badge()
                    ->color(Color::Indigo)
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('amount_discount')
                    ->sortable()
                    ->badge()
                    ->color(Color::Indigo)
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('amount_tax')
                    ->sortable()
                    ->badge()
                    ->color(Color::Indigo)
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('amount_subtotal')
                    ->sortable()
                    ->badge()
                    ->color(Color::Indigo)
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('amount_total')
                    ->sortable()
                    ->badge()
                    ->color(Color::Indigo),
                Tables\Columns\TextColumn::make('shipping_address')
                    ->sortable()
                    ->badge()
                    ->color(Color::Indigo)
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->badge()
                    ->color(Color::Indigo)
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->badge()
                    ->color(Color::Indigo)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                //                Tables\Actions\EditAction::make(),
                //                Action::make('openLink')
                //                    ->label('')
                //                    ->tooltip('View order')
                //                    ->icon('heroicon-o-eye')
                //                    ->action(fn ($record) => null)
                //                    ->color('primary')
                //                    ->url(fn ($record) => route('view-order', ['orderId' => $record->id]))
                //                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                //                Tables\Actions\BulkActionGroup::make([
                //                    Tables\Actions\DeleteBulkAction::make(),
                //                ]),
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

    public static function getNavigationBadge(): ?string
    {
        return cache()->remember('order_count', now()->addMinutes(5), function () {
            return Order::count();
        });
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
