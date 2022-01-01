<?php


namespace Modules\Product\Database;


use Illuminate\Database\Seeder;
use Modules\Product\Database\Seeders\ProductAttributeSeeder;
use Modules\Product\Database\Seeders\ProductCategorySeeder;
use Modules\Product\Database\Seeders\ProductSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ProductAttributeSeeder::class,
            ProductCategorySeeder::class,
            ProductSeeder::class,
        ]);
    }

}
