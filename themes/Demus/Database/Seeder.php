<?php
namespace Themes\Demus\Database;
use Database\Seeders\TemplateSeeder;
use Illuminate\Support\Facades\Artisan;
use Themes\Demus\Database\Seeders\ProductAttributeSeeder;
use Themes\Demus\Database\Seeders\ProductCategorySeeder;
use Themes\Demus\Database\Seeders\ProductSeeder;

class Seeder extends \Illuminate\Database\Seeder
{

    public function run(){
        Artisan::call('cache:clear');
        $this->call(GeneralSeeder::class);
        $this->call(ProductAttributeSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(TemplateSeeder::class);
        $this->call(NewsSeeder::class);
    }
}
