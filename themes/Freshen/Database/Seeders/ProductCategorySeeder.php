<?php
namespace Themes\Freshen\Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Themes\Freshen\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    public function run(){
        $categories =  [
            ['name' => 'Fruits', 'content' => '', 'status' => 'publish'],
            ['name' => 'Vegetables', 'content' => '', 'status' => 'publish'],
            ['name' => 'Drinks', 'content' => '', 'status' => 'publish'],
            ['name' => 'Bakery', 'content' => '', 'status' => 'publish'],
            ['name' => 'Butter & Egges', 'content' => '', 'status' => 'publish'],
            ['name' => 'Milks & Creams', 'content' => '', 'status' => 'publish'],
            ['name' => 'Drinks', 'content' => '', 'status' => 'publish'],
            ['name' => 'Meats', 'content' => '', 'status' => 'publish'],
            ['name' => 'Fish', 'content' => '', 'status' => 'publish'],
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
