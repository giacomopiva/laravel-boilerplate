<?php

namespace App\Console;

use App\Jobs\Backup;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
        // $schedule->command('inspire')->hourly();

        if (config('app.env') == 'production') {
            $schedule->command('backup:clean')->daily()->at('00:30');
            $schedule->command('backup:run')->daily()->at('01:00');
        } else {
            $schedule->command('backup:clean')->everyMinute();
            $schedule->command('backup:run')->everyMinute();
        }


    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
