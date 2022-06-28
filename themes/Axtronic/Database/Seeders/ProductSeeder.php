<?php
namespace Themes\Axtronic\Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Models\ProductBrand;
use Modules\Product\Models\ProductCategoryRelation;
use Modules\Product\Models\ProductTag;

class ProductSeeder extends \Themes\Base\Database\Seeders\ProductSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedSettings();

        $productImage = [
            'image-1'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-1', 'file_path' => 'axtronic/shop/image-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-2'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-2', 'file_path' => 'axtronic/shop/image-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-3'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-3', 'file_path' => 'axtronic/shop/image-3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-4'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-4', 'file_path' => 'axtronic/shop/image-4.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-5'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-5', 'file_path' => 'axtronic/shop/image-5.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-6'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-6', 'file_path' => 'axtronic/shop/image-6.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-7'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-mage-7', 'file_path' => 'axtronic/shop/image-7.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-8'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-8', 'file_path' => 'axtronic/shop/image-8.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-9'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-9', 'file_path' => 'axtronic/shop/image-9.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-10'  =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-10', 'file_path' => 'axtronic/shop/image-10.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-11'  =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-11', 'file_path' => 'axtronic/shop/image-11.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-12'  =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-12', 'file_path' => 'axtronic/shop/image-12.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-13'  =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-13', 'file_path' => 'axtronic/shop/image-13.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-15'  =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-15', 'file_path' => 'axtronic/shop/image-15.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-16'  =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-16', 'file_path' => 'axtronic/shop/image-16.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-17'  =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-17', 'file_path' => 'axtronic/shop/image-17.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-18'  =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-18', 'file_path' => 'axtronic/shop/image-18.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-19'  =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-19', 'file_path' => 'axtronic/shop/image-18.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-20'  =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-20', 'file_path' => 'axtronic/shop/image-20.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-21'  =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-21', 'file_path' => 'axtronic/shop/image-21.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-22'  =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-22', 'file_path' => 'axtronic/shop/image-22.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-23'  =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-23', 'file_path' => 'axtronic/shop/image-23.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-14'  =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-24', 'file_path' => 'axtronic/shop/image-24.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
        ];
        $productGallery = [
            'image-1'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-1', 'file_path' => 'demo/shop/product-image-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-2'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-2', 'file_path' => 'demo/shop/product-image-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-3'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-3', 'file_path' => 'demo/shop/product-image-3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-4'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-4', 'file_path' => 'demo/shop/product-image-4.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
        ];
        $brandName = [
            "Galaxy",
            'Casino',
            "Electrolux",
            "Amcrest",
            "Adidas",
            "Sony",
            "Samsung",
            "Syma",
            "Apple",
            "Asus",
        ];
        $productName = [
            'Apple MacBook Pro 13 Touch Bar M1 256GB 2020',
            "Apple Watch Series 7 41mm (GPS)",
            "Bluetooth Headphone Apple AirPodsMax",
            "Apple iphone 13 128GB",
            "Apple AirPods Pro",
            "Laptop ASUS VivoBook 15 A515EA",
            "Harman Kardon Onyx Studio 5",
            "Samsung Galaxy Tab S7 Plus",
            "Apple MacBook Pro 13 Touch Bar M1 256GB 2019",
            "iPhone 13 Pro Max 256GB",
            "Laptop ASUS Gaming ROG Strix G15 G513IH-HN015T",
            "Marshall Killburn 2",
            "Samsung Galaxy Z Fold3 5G",
            "Apple AirPods 2",
            "Bluetooth Beats Studio Buds",
            "Apple Watch Series 7 41mm (GPS) | Sport Band",
            "Surface Laptop Go Core i5 : 8GB : 128 GB : 12.4 inch",
            "Macbook Pro 14 inch 2021 | 8 CPU | 14 GPU | 16GB | 512GB",
            "Samsung Galaxy Z Flip3 5G",
            "iPhone 13 Pro Max 128GB | 256GB | 512GB | 1TB",
            "Apple MacBook Air M1 256GB",
            "Bluetooth Speaker JBL Flip 5",
            "Oculus Quest 2 ( 128GB )",
        ];

        $productBrand = ProductBrand::factory()->count(count($brandName))->sequence(function ($sequent)use ($brandName){
            return ['name'=>$brandName[$sequent->index]];
        })->create();

        ProductTag::factory()->count(10)->create();

        Product::factory()
            ->times(count($productName))
            ->sequence(function ($sequent)use($productName,$productBrand,$productImage,$productGallery){
                $product_type = ['simple','variable'][rand(0,1)];
                if($sequent->index == 0){
                    $product_type = 'simple';
                }
                if($sequent->index == 1){
                    $product_type = 'variable';
                }
                if($sequent->index == 2){
                    $product_type = 'external';
                }
                return [
                    'title'=>$productName[$sequent->index],
                    'brand_id'=>$productBrand->random(1)->first()->id,
                    'image_id'=> $productImage["image-".($sequent->index + 1)] ?? $productImage['image-1'],
                    'gallery'     => implode(',',$productGallery),
                    'product_type'=> $product_type,
                    'is_featured'=> true,
                ];
            })
            ->create();

    }

}
