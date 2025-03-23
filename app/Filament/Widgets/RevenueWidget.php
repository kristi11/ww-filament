<?php

namespace App\Filament\Widgets;

use App\Models\PublicPage;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Balance;
use Stripe\Refund;
use Stripe\Dispute;

class RevenueWidget extends BaseWidget
{
    public static function canView(): bool
    {
        return PublicPage::where('shop', true)->exists();
    }
    protected function getHeading(): string
    {
        return 'Revenue information';
    }
    protected function getDescription(): string
    {
        return 'The shop revenue details';
    }

    /**
     * @throws ApiErrorException
     */
    protected function getStats(): array
    {
        // Set Stripe API key
        Stripe::setApiKey(config('services.stripe.secret'));

        // Define start of the month for time-scoped metrics
        $startOfMonth = now()->startOfMonth()->timestamp;

        // Fetch all charges (successful payments, no time filter)
        $charges = Charge::all([
            'limit' => 100,
            'status' => 'succeeded',
        ]);
        $totalRevenueCents = collect($charges->data)->sum('amount');
        $totalRevenue = $totalRevenueCents / 100;

        // Fetch pending balance
        $balance = Balance::retrieve();
        $pendingBalance = collect($balance->pending)->sum('amount') / 100;

        // Fetch total refunds (this month)
        $refunds = Refund::all([
            'limit' => 100,
            'created' => ['gte' => $startOfMonth],
        ]);
        $totalRefunds = collect($refunds->data)->sum('amount') / 100;

        // Fetch failed payments (this month)
        $failedCharges = Charge::all([
            'limit' => 100,
            'status' => 'failed',
            'created' => ['gte' => $startOfMonth],
        ]);
        $failedPayments = count($failedCharges->data);

        // Fetch chargebacks (this month)
        $disputes = Dispute::all([
            'limit' => 100,
            'created' => ['gte' => $startOfMonth],
        ]);
        $chargebacks = count($disputes->data);

        // Fetch top customer revenue (this month)
        $monthlyCharges = Charge::all([
            'limit' => 100,
            'status' => 'succeeded',
            'created' => ['gte' => $startOfMonth],
        ]);
        $topCustomer = !empty($monthlyCharges->data)
            ? collect($monthlyCharges->data)
                ->groupBy('customer')
                ->map(fn($group) => $group->sum('amount') / 100)
                ->sortDesc()
                ->take(1)
                ->all()
            : [];
        $topCustomerId = array_key_first($topCustomer) ?? 'None';
        $topCustomerRevenue = $topCustomer[$topCustomerId] ?? 0;

        return [
            Stat::make('Total Revenue (Stripe)', '$' . number_format($totalRevenue, 2))
                ->description('Revenue from Stripe charges')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('success'),
            Stat::make('Pending Balance', '$' . number_format($pendingBalance, 2))
                ->description('Funds awaiting payout')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),
            Stat::make('Total Refunds', '$' . number_format($totalRefunds, 2))
                ->description('This month')
                ->descriptionIcon('heroicon-o-arrow-path')
                ->color('danger'),
            Stat::make('Failed Payments', $failedPayments)
                ->description('This month')
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger'),
            Stat::make('Chargebacks', $chargebacks)
                ->description('This month')
                ->descriptionIcon('heroicon-o-shield-exclamation')
                ->color('danger'),
            Stat::make('Top Customer Revenue', '$' . number_format($topCustomerRevenue, 2))
                ->description($topCustomerId === 'None' ? 'No data' : "Customer ID: $topCustomerId")
                ->descriptionIcon('heroicon-o-star')
                ->color('success'),
        ];
    }
}
