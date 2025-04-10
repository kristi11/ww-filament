<?php

namespace App\Console;

use App\Console\Commands\AbandonedCart;
use App\Console\Commands\RemoveInactiveSessionCarts;
use Cmsmaxinc\FilamentSystemVersions\Commands\CheckDependencyVersions;
use Edwink\FilamentUserActivity\Http\Middleware\RecordUserActivity;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Spatie\Health\Commands\RunHealthChecksCommand;

class Kernel extends ConsoleKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected array $middleware = [
        RecordUserActivity::class,
    ];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command(RunHealthChecksCommand::class)->everyMinute();
        $schedule->command(AbandonedCart::class)->dailyAt('13:00');
        $schedule->command(RemoveInactiveSessionCarts::class)->weekly();
        $schedule->call(CheckDependencyVersions::class)->daily();

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
