<?php

namespace App\Console\Commands;

use Cache;
use Illuminate\Console\Command;

class ScheduleCheckCommand extends Command
{
    protected $signature = 'bc_schedule:check';

    protected $description = 'Check status schedule';

    public function handle()
    {
        $toDay = date('Y-m-d');
        $lastTime = Cache::get('last_schedule_check');
        if(empty($lastTime) or $lastTime != $toDay){
            Cache::remember('last_schedule_check',now()->add('1 days'),function() use($toDay){
                return date('Y-m-d',strtotime('+1 days'));
            });
        }

        $this->info(__('Last Check :time',['time'=>display_date($toDay)]));
    }
}
