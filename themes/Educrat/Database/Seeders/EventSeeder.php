<?php


namespace Themes\Educrat\Database\Seeders;


use Illuminate\Database\Seeder;
use Themes\Educrat\Modules\Event\Models\Event;

class EventSeeder extends Seeder
{

    public function run(){
        Event::factory()
            ->times(300)
            ->create();
    }
}
