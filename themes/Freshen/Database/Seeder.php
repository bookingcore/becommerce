<?php
namespace Themes\Freshen\Database;
use Illuminate\Support\Facades\Artisan;
use Themes\Freshen\Database\Seeders\ProductAttributeSeeder;
use Themes\Freshen\Database\Seeders\ProductCategorySeeder;
use Themes\Freshen\Database\Seeders\ProductSeeder;

class Seeder extends \Illuminate\Database\Seeder
{

    public function run(){
        Artisan::call('cache:clear');
        $this->call(GeneralSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(ProductAttributeSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(ProductSeeder::class);
    }
}
