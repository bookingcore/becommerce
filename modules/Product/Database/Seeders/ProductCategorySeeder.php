<?php


namespace Modules\Product\Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Product\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    public function run(){
        $cat_image = [
            'image-1' => DB::table('media_files')->insertGetId( ['file_name' => 'cat-image-1', 'file_path' => 'demo/templates/cat-image-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-2' => DB::table('media_files')->insertGetId( ['file_name' => 'cat-image-2', 'file_path' => 'demo/templates/cat-image-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-3' => DB::table('media_files')->insertGetId( ['file_name' => 'cat-image-3', 'file_path' => 'demo/templates/cat-image-3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-4' => DB::table('media_files')->insertGetId( ['file_name' => 'cat-image-4', 'file_path' => 'demo/templates/cat-image-4.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-5' => DB::table('media_files')->insertGetId( ['file_name' => 'cat-image-5', 'file_path' => 'demo/templates/cat-image-5.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-6' => DB::table('media_files')->insertGetId( ['file_name' => 'cat-image-6', 'file_path' => 'demo/templates/cat-image-6.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-7' => DB::table('media_files')->insertGetId( ['file_name' => 'cat-image-7', 'file_path' => 'demo/templates/cat-image-7.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-8' => DB::table('media_files')->insertGetId( ['file_name' => 'cat-image-8', 'file_path' => 'demo/templates/cat-image-8.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
        ];
        $categories =  [
            ['name' => 'Clothing & Apparel', 'image_id' => $cat_image['image-1'], 'content' => '', 'status' => 'publish',
                'child' => [
                    ['name' => 'Womens', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Mens', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Shoes', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Bags', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Sunglasses', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Accessories', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Kid’s Fashion', 'content' => '', 'status' => 'publish'],
                ]
            ],
            ['name' => 'Garden & Kitchen', 'image_id' => $cat_image['image-2'], 'content' => '', 'status' => 'publish',
                'child' => [
                    ['name' => 'Decoration', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Furniture', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Garden Tools', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Home Improvement', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Powers And Hand Tools', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Utensil & Gadget', 'content' => '', 'status' => 'publish'],
                ]
            ],
            ['name' => 'Consumer Electrics', 'image_id' => $cat_image['image-3'], 'content' => '', 'status' => 'publish',
                'child' => [
                    ['name' => 'Air Conditioners', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Audios & Theaters', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Car Electronics', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Office Electronics', 'content' => '', 'status' => 'publish'],
                    ['name' => 'TV Televisions', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Washing Machines', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Refrigerators', 'content' => '', 'status' => 'publish'],
                ]
            ],
            ['name' => 'Health & Beauty', 'image_id' => $cat_image['image-4'], 'content' => '', 'status' => 'publish',
                'child' => [
                    ['name' => 'Equipments', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Hair Care', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Perfumer', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Skin Care', 'content' => '', 'status' => 'publish'],
                ]
            ],
            ['name' => 'Computers & Technologies', 'image_id' => $cat_image['image-5'], 'content' => '', 'status' => 'publish',
                'child' => [
                    ['name' => 'Desktop PC', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Laptop', 'content' => '', 'status' => 'publish'],
                    ['name' => 'Smartphones', 'content' => '', 'status' => 'publish'],
                ]
            ],
            ['name' => 'Jewelry & Watches', 'image_id' => $cat_image['image-6'], 'content' => '', 'status' => 'publish',
                'child' => [
                    ['name' => 'Gemstone Jewelry', 'content' => '', 'status' => 'publish'],
                    ['name' => "Men's Watches", 'content' => '', 'status' => 'publish'],
                    ['name' => "Women's Watches", 'content' => '', 'status' => 'publish'],
                ]
            ],
            ['name' => 'Phones & Accessories', 'image_id' => $cat_image['image-7'], 'content' => '', 'status' => 'publish',
                'child' => [
                    ['name' => 'Iphone 8', 'content' => '', 'status' => 'publish'],
                    ['name' => "Iphone X", 'content' => '', 'status' => 'publish'],
                    ['name' => "Samsung Note 8", 'content' => '', 'status' => 'publish'],
                    ['name' => "Samsung S8", 'content' => '', 'status' => 'publish'],
                ]
            ],
            ['name' => 'Sport & Outdoor', 'image_id' => $cat_image['image-8'], 'content' => '', 'status' => 'publish',
                'child' => [
                    ['name' => 'Freezer Burn', 'content' => '', 'status' => 'publish'],
                    ['name' => "Fridge Cooler", 'content' => '', 'status' => 'publish'],
                    ['name' => "Wine Cabinets", 'content' => '', 'status' => 'publish'],
                ]
            ],
            ['name' => 'Babies & Moms', 'content' => '', 'status' => 'publish'],
            ['name' => 'Books & Office', 'content' => '', 'status' => 'publish'],
            ['name' => 'Cars & Motocycles', 'content' => '', 'status' => 'publish'],
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
