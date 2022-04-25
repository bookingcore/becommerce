<?php

namespace App\Console;

use App\Console\Commands\Campaign\ScanSaleEndCommand;
use App\Console\Commands\Campaign\ScanSaleStartCommand;
use App\Console\Commands\ScheduleCheckCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Modules\Vendor\Commands\CreatePayoutsCommand;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('sanctum:prune-expired --hours=24')->daily();

        if(!\Cache::has('last_schedule_check') or (now() > \Cache::get('last_schedule_check'))){
            $schedule->command(ScheduleCheckCommand::class)->withoutOverlapping();
        }
        $schedule->command(CreatePayoutsCommand::class)->monthlyOn(15);

        $schedule->command(ScanSaleStartCommand::class)->dailyAt('00:00');
        $schedule->command(ScanSaleEndCommand::class)->dailyAt('00:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        $this->load(base_path('/modules/Vendor/Commands'));

        require base_path('routes/console.php');
    }
}
