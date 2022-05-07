<?php


namespace Themes\Axtronic\Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Product\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    public function run(){
        $categories =  [
            ['name' => 'Computers & Accessories', 'image_id' => '', 'content' => '', 'status' => 'publish',
                'child' => [
                    ['name' => 'Gaming PC', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Office PC', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Laptops', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Screen', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Keyboard', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Gaming Chair', 'content' => '', 'status' => 'publish'],
                ]
            ],
            ['name' => 'Cell Phones', 'image_id' => '', 'content' => '', 'status' => 'publish',
                'child' => [
                    ['name' => 'Apple Watch', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Samsung', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Xiaomi', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Oppo', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Huawei', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Amazfit', 'content' => '', 'status' => 'publish'],
                ]
            ],
            ['name' => 'Watchs', 'image_id' => '', 'content' => '', 'status' => 'publish',
                'child' => [
                    ['name' => 'iPhone', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Ipad', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Samsung', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Xiaomi', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Huawei', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Realme', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Oppo', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Asus', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Oneplus', 'content' => '', 'status' => 'publish'],
                ]
            ],
            ['name' => 'Camera & Photo', 'content' => '', 'status' => 'publish'],
            ['name' => 'Game Consoles & Accessories', 'content' => '', 'status' => 'publish'],
            ['name' => 'GPS & Navigation', 'content' => '', 'status' => 'publish'],
            ['name' => 'Headphones', 'content' => '', 'status' => 'publish'],
            ['name' => 'Wearable Technology', 'content' => '', 'status' => 'publish']
        ];
        foreach ($categories as $category){
            if(!empty($category['child'])){
                $child = $category['child'];
                unset($category['child']);
                ProductCategory::factory()
                    ->count(1)
                    ->sequence(function () use($category){
                        return $category;
                    })
                    ->has(ProductCategory::factory()->count(count($child))->sequence(function ($sequent) use($child){
                        return $child[$sequent->index];
                    }),'child')->create();
            }else{
                ProductCategory::factory()
                    ->count(1)
                    ->sequence(function () use($category){
                        return $category;
                    })
                    ->create();
            }
        }
    }

}
