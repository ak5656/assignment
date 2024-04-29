<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Jobs;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */

     protected $commands = [
        'App\Console\Commands\Dojobs'
      ];

    protected function schedule(Schedule $schedule): void
    {
        $jobs = Jobs::all();
        foreach ($jobs as $jb) {
            $frequency = $jb->frequency;
            // $schedule->call(function() use($jb){
            //     $jb->exec('curl -X GET http://assignment.local/myjob/task2');
            // })->sendOutputTo(public_path().'\jobtask\log.txt')->$frequency();

            $schedule->exec('curl -X GET ' . $jb->joburl)->$frequency()
        ->sendOutputTo(public_path().'\jobtask\log.txt');

        }    
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
