<?php
namespace Themes\Base\Database;
use Database\Seeders\TemplateSeeder;
use Illuminate\Support\Facades\Artisan;
use Themes\Base\Database\Seeders\GeneralSeeder;
use Themes\Base\Database\Seeders\ProductAttributeSeeder;
use Themes\Base\Database\Seeders\ProductCategorySeeder;
use Themes\Base\Database\Seeders\ProductSeeder;

class Seeder extends \Illuminate\Database\Seeder
{

    public function run(){
        Artisan::call('cache:clear');
        $this->call(GeneralSeeder::class);
        $this->call(ProductAttributeSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(TemplateSeeder::class);
    }
}
