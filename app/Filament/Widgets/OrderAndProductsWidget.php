<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderAndProductsWidget extends BaseWidget
{
    protected function getColumns() : int{
        return 2;
    }
    protected function getHeading(): string
    {
        return 'Orders and Products';
    }
    protected function getDescription(): string
    {
        return 'The total orders and products in the database';
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Orders', Order::count())
                ->description('The total orders placed')
                ->descriptionIcon('heroicon-o-shopping-bag')
                ->color('primary'),
            Stat::make('Products', Product::count())
                ->description('The total products in the database')
                ->descriptionIcon('heroicon-o-beaker')
                ->color('primary'),
        ];
    }
}
