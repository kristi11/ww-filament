<?php

namespace App\Filament\Customer\Resources\CustomerAppointmentResource\Widgets;

use App\Enums\Visibility;
use App\Models\User;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TeamMembersWidget extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::whereHas('roles', function ($query) {
                    $query->where('name', 'team_user');
                })
            )
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('email')
                    ->badge()
                    ->color('primary'),
                IconColumn::make('is_team_user')
                    ->color(function ($state) {
                        return Visibility::from($state)->getVisibility();
                    })
                    ->boolean()
                    ->label('Team Member'),
                TextColumn::make('created_at')
                    ->label('Member since')
                    ->date()
                    ->badge()
                    ->color('gray'),
            ])
            ->paginated(false);
    }
}
