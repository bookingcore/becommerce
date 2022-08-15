<?php


namespace Themes\Demus\Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Product\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    public function run(){
        $categorieImage = [
            'image-1'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'category-image-1', 'file_path' => 'demus/category/image_1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-2'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'category-image-2', 'file_path' => 'demus/category/image_7.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-3'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'category-image-3', 'file_path' => 'demus/category/image_8.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-4'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'category-image-4', 'file_path' => 'demus/category/image_9.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-5'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'category-image-5', 'file_path' => 'demus/category/image_10.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-6'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'category-image-6', 'file_path' => 'demus/category/image_11.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-7'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'category-image-7', 'file_path' => 'demus/category/image_12.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
        ];
        $categories =  [
            ['name' => 'Chairs', 'image_id' => $categorieImage['image-2'], 'content' => '', 'status' => 'publish',
                'child' => [
                    ['name' => 'Chair 1', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Chair 2', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Chair 3', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Chair 4', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Chair 5', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Chair 6', 'content' => '', 'status' => 'publish'],
                ]
            ],
            ['name' => 'Stools','image_id' => $categorieImage['image-3'], 'content' => '', 'status' => 'publish'],
            ['name' => 'Sofas','image_id' => $categorieImage['image-4'], 'content' => '', 'status' => 'publish'],
            ['name' => 'Lighting','image_id' => $categorieImage['image-5'], 'content' => '', 'status' => 'publish'],
            ['name' => 'Furnitures','image_id' => $categorieImage['image-6'], 'content' => '', 'status' => 'publish'],
            ['name' => 'Decor', 'image_id' => $categorieImage['image-7'],'content' => '', 'status' => 'publish'],
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
