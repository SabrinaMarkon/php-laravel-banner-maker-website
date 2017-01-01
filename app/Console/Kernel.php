<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
        Commands\SendEmails::class,
    ];

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
        // $schedule->command('SendEmails')->everyFiveMinutes(); where SendEmails is the name of the class, OR the below:
        $schedule->command('emails:send')
            ->everyFiveMinutes()->withoutOverlapping();

        // $schedule->command('CreateThumbnails')->monthlyOn(1, '01:00')->withoutOverlapping(); where CreateThumbnails is the name of the class, OR the below.
        // withoutOverlapping prevents another command from starting before the first is completed.
        $schedule->command('thumbnails:create')->monthlyOn(1, '01:00')->withoutOverlapping();

    }
}
