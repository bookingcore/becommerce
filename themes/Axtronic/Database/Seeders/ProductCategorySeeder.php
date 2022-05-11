<?php


namespace Themes\Axtronic\Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Product\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    public function run(){
        $catImage = [
            'image-1'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'cat-image-1', 'file_path' => 'axtronic/category/h7-cat1.jpg', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-2'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'cat-image-2', 'file_path' => 'axtronic/category/h7-cat2.jpg', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-3'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'cat-image-3', 'file_path' => 'axtronic/category/h7-cat3.jpg', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-4'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'cat-image-4', 'file_path' => 'axtronic/category/h7-cat4.jpg', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-5'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'cat-image-5', 'file_path' => 'axtronic/category/h7-cat5.jpg', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-6'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'cat-image-6', 'file_path' => 'axtronic/category/h7-cat6.jpg', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-7'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'cat-image-7', 'file_path' => 'axtronic/category/h7-cat7.jpg', 'file_type' => 'image/png', 'file_extension' => 'png']),
        ];
        $categories =  [
            ['name' => 'Computers & Accessories', 'image_id' =>  \$catImage["image-1"], 'content' => '', 'status' => 'publish',
                'child' => [
                    ['name' => 'Gaming PC', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Office PC', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Laptops', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Screen', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Keyboard', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Gaming Chair', 'content' => '', 'status' => 'publish'],
                ]
            ],
            ['name' => 'Cell Phones', 'image_id' => \$catImage["image-2"], 'content' => '', 'status' => 'publish',
                'child' => [
                    ['name' => 'Apple Watch', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Samsung', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Xiaomi', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Oppo', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Huawei', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Amazfit', 'content' => '', 'status' => 'publish'],
                ]
            ],
            ['name' => 'Watchs', 'image_id' =>  \$catImage["image-3"], 'content' => '', 'status' => 'publish',
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
            ['name' => 'Camera & Photo', 'image_id' =>  \$catImage["image-4"], 'content' => '', 'status' => 'publish'],
            ['name' => 'Game Consoles & Accessories', 'image_id' =>  \$catImage["image-5"], 'content' => '', 'status' => 'publish'],
            ['name' => 'GPS & Navigation', 'image_id' =>  \$catImage["image-6"], 'content' => '', 'status' => 'publish'],
            ['name' => 'Headphones', 'image_id' =>  \$catImage["image-7"], 'content' => '', 'status' => 'publish'],
            ['name' => 'Wearable Technology', 'image_id' =>  \$catImage["image-1"], 'content' => '', 'status' => 'publish']
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
