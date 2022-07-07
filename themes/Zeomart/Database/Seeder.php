<?php
namespace Themes\Zeomart\Database;
use Illuminate\Support\Facades\Artisan;

class Seeder extends \Illuminate\Database\Seeder
{

    public function run(){
        Artisan::call('cache:clear');
        $this->call(GeneralSeeder::class);
    }
}
