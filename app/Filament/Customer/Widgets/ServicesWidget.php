<?php

namespace App\Filament\Customer\Widgets;

use App\Filament\Resources\ServiceResource;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ServicesWidget extends BaseWidget
{
    //    protected int | string | array $columnSpan = 'full';

    protected static ?string $maxHeight = '200px';

    public function table(Table $table): Table
    {
        return $table
            ->queryStringIdentifier('services')
            ->contentGrid([
                'md' => 1,
                'xl' => 1,
            ])
            ->query(
                ServiceResource::getEloquentQuery()
            )
            ->columns([
                Split::make([
                    TextColumn::make('name')
                        ->sortable()
                        ->icon('heroicon-o-bars-3-bottom-left')
                        ->tooltip('name'),
                ]),
                Panel::make([
                    TextColumn::make('name')
                        ->sortable()
                        ->label('Edit')
                        ->icon('heroicon-o-bars-3-bottom-left')
                        ->tooltip('name'),

                    TextColumn::make('description')
                        ->html()
                        ->sortable()
                        ->tooltip('Description'),
                    TextColumn::make('display_price')
                        ->money()
                        ->sortable()
                        ->icon('heroicon-o-currency-dollar')
                        ->tooltip('Price'),
                    TextColumn::make('estimated_hours')
                        ->numeric()
                        ->sortable()
                        ->icon('heroicon-o-clock')
                        ->tooltip('Estimated Hours')
                        ->suffix(' hours'),
                    TextColumn::make('estimated_minutes')
                        ->numeric()
                        ->sortable()
                        ->icon('heroicon-o-clock')
                        ->tooltip('Estimated Minutes')
                        ->suffix(' minutes'),
                    TextColumn::make('extra_description')
                        ->html()
                        ->sortable()
                        ->tooltip('Extra Description'),
                ])
                    ->collapsible(),
            ])
            ->paginationPageOptions([4, 5, 10, 25, 50])
            ->defaultPaginationPageOption(4);
    }
}
