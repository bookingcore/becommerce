<?php
namespace Modules\Product\Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Models\ProductBrand;
use Modules\Product\Models\ProductCategoryRelation;

class ProductSeeder extends Seeder
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
            'image-1'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-1', 'file_path' => 'demo/product/product-image-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
        ];
        $productGallery = [
            'image-1'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'gallery-image-1', 'file_path' => 'demo/product/gallery-image-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-2'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'gallery-image-2', 'file_path' => 'demo/product/gallery-image-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-3'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'gallery-image-3', 'file_path' => 'demo/product/gallery-image-3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-4'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'gallery-image-4', 'file_path' => 'demo/product/gallery-image-4.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
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
            'Sleeve Linen Blend Caro Pane Shirt',
            "Paul’s Smith Sneaker InWhite Color",
            "Herschel Leather Duffle Bag In Brown Color",
            "Unero Military Classical Backpack",
            "Rayban Rounded Sunglass Brown Color",
            "Korea Long Sofa Fabric In Blue Navy Color",
            "LG White Front Load Steam Washer",
            "Men’s Sports Runnning Swim Board Shorts"
        ];

        $productBrand = ProductBrand::factory()->count(count($brandName))->sequence(function ($sequent)use ($brandName){
            return ['name'=>$brandName[$sequent->index]];
        })->create();

         Product::factory()
            ->count(count($productName))
            ->sequence(function ($sequent)use($productName,$productBrand,$productImage,$productGallery){
                return [
                    'title'=>$productName[$sequent->index],
                    'brand_id'=>$productBrand->random(1)->first()->id,
                    'image_id'=> \Arr::random($productImage),
                    'gallery'     => implode(',',$productGallery),
                ];
            })
            ->create();

        //product search Sliders
        DB::table('core_settings')->insertGetId([
            'name'  =>  'product_page_search_title',
            'group' =>  'product',
            'val'   =>  'Shop'
        ]);
        DB::table('core_settings')->insertGetId([
            'name'  =>  'product_policies',
            'group' =>  'product',
            'val'   =>  '[{"title":"Shipping Policy","content":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla auctor aliquam tortor at suscipit. Etiam accumsan, est id vehicula cursus, eros ligula suscipit massa, sed auctor felis mi eu massa. Sed vulputate nisi nibh, vel maximus velit auctor nec. Integer consectetur elementum turpis, nec fermentum ipsum tempor quis. Praesent a quam congue, egestas erat sit amet, finibus justo. Quisque viverra neque vehicula eros gravida ultricies. Ut lacinia enim nec consequat tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus ultricies ornare feugiat. Donec vitae rhoncus sapien, ac aliquet nunc."},{"title":"Refund Policy","content":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla auctor aliquam tortor at suscipit. Etiam accumsan, est id vehicula cursus, eros ligula suscipit massa, sed auctor felis mi eu massa. Sed vulputate nisi nibh, vel maximus velit auctor nec. Integer consectetur elementum turpis, nec fermentum ipsum tempor quis. Praesent a quam congue, egestas erat sit amet, finibus justo. Quisque viverra neque vehicula eros gravida ultricies. Ut lacinia enim nec consequat tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus ultricies ornare feugiat. Donec vitae rhoncus sapien, ac aliquet nunc."},{"title":"Cancellation \/ Return \/ Exchange Policy","content":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla auctor aliquam tortor at suscipit. Etiam accumsan, est id vehicula cursus, eros ligula suscipit massa, sed auctor felis mi eu massa. Sed vulputate nisi nibh, vel maximus velit auctor nec. Integer consectetur elementum turpis, nec fermentum ipsum tempor quis. Praesent a quam congue, egestas erat sit amet, finibus justo. Quisque viverra neque vehicula eros gravida ultricies. Ut lacinia enim nec consequat tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus ultricies ornare feugiat. Donec vitae rhoncus sapien, ac aliquet nunc."}]'
        ]);
    }

    public function seedSettings(){
        $settings = [
            'product_enable_review' => 1,
            'guest_checkout'        => 1,
            'email_c_new_order_enable'  => 1,
            'email_c_new_order_subject' => __("Thanks for shopping with us"),
            'email_v_new_order_enable'  => 1,
            'email_v_new_order_subject' => __("[site_title]: New order #[order_number]"),
            'email_a_new_order_enable'  => 1,
            'email_a_new_order_subject' => __("[site_title]: New order #[order_number]"),
        ];
        foreach ($settings as $setting=>$val){
            setting_update_item($setting,$val);
        }
    }
}
