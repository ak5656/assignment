<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Jobs;

class Dojobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:dojobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $jobs = Jobs::all();
        // foreach ($jobs as $jb) {
        //     return redirect($jb->joburl);
        // }
    }
}
