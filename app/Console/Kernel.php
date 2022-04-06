<?php

namespace App\Console;

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
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->command(ScheduleCheckCommand::class)->dailyAt("00:05");
        $schedule->command(CreatePayoutsCommand::class)->monthlyOn(15);
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
