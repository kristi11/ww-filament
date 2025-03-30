<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Colors\Color;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('Shop')
            ->url(function () {
                return route('shop');
            })
            ->icon('heroicon-o-building-storefront')
            ->openUrlInNewTab()
            ->tooltip('Go to shop')
            ->color(Color::Lime)
        ];
    }
}
