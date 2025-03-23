<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class UsersChartWidget extends ChartWidget
{
    protected static ?string $heading = 'User signups';
    protected int | string |array $columnSpan = 'full';
    protected static ?string $maxHeight = '200px';
    public ?string $filter = 'year';

    protected function getFilters() : ?array{
        return [
            'week' => 'Last week',
            'month' => 'Last month',
            'quarter' => 'Last quarter',
            'year' => 'Last year',
        ];
    }

    public function getHeading(): string
    {
        return 'User signups';
    }

    public function getDescription(): string
    {
        return 'The user signup trend over different time periods';
    }

    protected function getData(): array
    {
        $filter = $this->filter;
        match ($filter) {
            'week' => $data = Trend::model(User::class)
                ->between(
                    start: now()->subWeek(),
                    end: now(),
                )
                ->perDay()
                ->count(),
            'month' => $data = Trend::model(User::class)
                ->between(
                    start: now()->subMonth(),
                    end: now(),
                )
                ->perDay()
                ->count(),
            'quarter' => $data = Trend::model(User::class)
                ->between(
                    start: now()->subQuarter(),
                    end: now(),
                )
                ->perMonth()
                ->count(),
            'year' => $data = Trend::model(User::class)
                ->between(
                    start: now()->subYear(),
                    end: now(),
                )
                ->perMonth()
                ->count(),
        };

        return [
            'datasets' => [
                [
                    'label' => 'User signups',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
