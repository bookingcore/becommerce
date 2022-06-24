<?php
namespace Themes\Axtronic\Database;
use Illuminate\Support\Facades\Artisan;
use Themes\Axtronic\Database\Seeders\ProductAttributeSeeder;
use Themes\Axtronic\Database\Seeders\ProductCategorySeeder;
use Themes\Axtronic\Database\Seeders\ProductSeeder;

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
