<?php
namespace Themes\Freshen\Database;
use Illuminate\Support\Facades\Artisan;

class Seeder extends \Illuminate\Database\Seeder
{

    public function run(){
        Artisan::call('cache:clear');
        $this->call(MediaFileSeeder::class);
        $this->call(GeneralSeeder::class);
        //$this->call(ProductSeeder::class);
    }
}
