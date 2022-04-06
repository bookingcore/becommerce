<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ScheduleCheckCommand extends Command
{
    protected $signature = 'schedule:check';

    protected $description = 'Check status schedule';

    public function handle()
    {
        $toDay = date('Y-m-d');
        $lastTime = setting_item('last_schedule_check');
        if(empty($lastTime) or $lastTime != $toDay){
            $lastTime =setting_update_item('last_schedule_check',$toDay);
            $lastTime = $lastTime['val'];
        }else{

        }

        $this->info(__('Last Check :time',['time'=>display_date($lastTime)]));
    }
}
