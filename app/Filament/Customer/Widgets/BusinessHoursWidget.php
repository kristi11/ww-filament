<?php

namespace App\Filament\Customer\Widgets;

use App\Filament\Resources\BusinessHourResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class BusinessHoursWidget extends BaseWidget
{
    //    protected int | string | array $columnSpan = 'full';

    protected static ?string $maxHeight = '200px';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                BusinessHourResource::getEloquentQuery()
            )
            ->columns([
                Tables\Columns\TextColumn::make('day'),
                Tables\Columns\TextColumn::make('display_open')
//                    ->time(format: 'h:i A')
                    ->label('Open')
                    ->placeholder('Closed')
                    ->badge(),
                Tables\Columns\TextColumn::make('display_close')
//                    ->time(format: 'h:i A')
                    ->label('Close')
                    ->placeholder('Closed')
                    ->badge(),
            ])
            ->paginated(false);
    }
}
