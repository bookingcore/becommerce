<?php


namespace Themes\Demus\Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Product\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    public function run(){
        $categories =  [
            ['name' => 'Chairs', 'image_id' => '', 'content' => '', 'status' => 'publish',
                'child' => [
                    ['name' => 'Chair 1', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Chair 2', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Chair 3', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Chair 4', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Chair 5', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Chair 6', 'content' => '', 'status' => 'publish'],
                ]
            ],
            ['name' => 'Stools', 'content' => '', 'status' => 'publish'],
            ['name' => 'Sofas', 'content' => '', 'status' => 'publish'],
            ['name' => 'Lighting', 'content' => '', 'status' => 'publish'],
            ['name' => 'Furnitures', 'content' => '', 'status' => 'publish'],
            ['name' => 'Decor', 'content' => '', 'status' => 'publish'],
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
