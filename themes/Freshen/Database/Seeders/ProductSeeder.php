<?php
namespace Themes\Freshen\Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Models\ProductBrand;
use Modules\Product\Models\ProductCategoryRelation;
use Modules\Product\Models\ProductTag;

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
            'image-1'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-1', 'file_path' => 'freshen/shop-items/fp1.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-2'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-2', 'file_path' => 'freshen/shop-items/fp2.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-3'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-3', 'file_path' => 'freshen/shop-items/fp3.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-4'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-4', 'file_path' => 'freshen/shop-items/fp4.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-5'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-5', 'file_path' => 'freshen/shop-items/fp5.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-6'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-6', 'file_path' => 'freshen/shop-items/fp6.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-7'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-7', 'file_path' => 'freshen/shop-items/fp7.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-8'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-8', 'file_path' => 'freshen/shop-items/fp8.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-9'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-9', 'file_path' => 'freshen/shop-items/fp9.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-10'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-10', 'file_path' => 'freshen/shop-items/fp10.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
        ];
        $productGallery = [
            'image-1'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-gallery-1', 'file_path' => 'freshen/product/ss1.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-2'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-gallery-2', 'file_path' => 'freshen/product/ss2.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-3'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-gallery-3', 'file_path' => 'freshen/product/ss3.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-4'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-gallery-4', 'file_path' => 'freshen/product/ss4.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
        ];
        $productName = [
            'Pineapple (Tropical Gold)',
            "Silver Heinz Ketchup",
            "Augason Farms Freeze Dried Beef Chunks ",
            "Organic Rocket",
            "Silver Heinz Ketchup",
            "Charred Spring Onions & Romesco",
            "Cheesy Sprout Fondue",
            "Faux Gras With Toast And Pickles",
            "Gravadlax With Celeriac & Fennel Salad",
            "Chicken Liver & Pineau Pâté"
        ];
        $brandName = [
            "PepsiCo",
            'Red Bull',
            'Banania',
            'Vinamilk',
            'Highlands Coffee',
        ];
        $productBrand = ProductBrand::factory()->count(count($brandName))->sequence(function ($sequent)use ($brandName){
            return ['name'=>$brandName[$sequent->index]];
        })->create();

        ProductTag::factory()->count(10)->create();

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

    }

    public function seedSettings(){
        $settings = [
            'product_page_search_title'=>'Shop',
            'product_policies'=>'[{"title":"Shipping Policy","content":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla auctor aliquam tortor at suscipit. Etiam accumsan, est id vehicula cursus, eros ligula suscipit massa, sed auctor felis mi eu massa. Sed vulputate nisi nibh, vel maximus velit auctor nec. Integer consectetur elementum turpis, nec fermentum ipsum tempor quis. Praesent a quam congue, egestas erat sit amet, finibus justo. Quisque viverra neque vehicula eros gravida ultricies. Ut lacinia enim nec consequat tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus ultricies ornare feugiat. Donec vitae rhoncus sapien, ac aliquet nunc."},{"title":"Refund Policy","content":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla auctor aliquam tortor at suscipit. Etiam accumsan, est id vehicula cursus, eros ligula suscipit massa, sed auctor felis mi eu massa. Sed vulputate nisi nibh, vel maximus velit auctor nec. Integer consectetur elementum turpis, nec fermentum ipsum tempor quis. Praesent a quam congue, egestas erat sit amet, finibus justo. Quisque viverra neque vehicula eros gravida ultricies. Ut lacinia enim nec consequat tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus ultricies ornare feugiat. Donec vitae rhoncus sapien, ac aliquet nunc."},{"title":"Cancellation \/ Return \/ Exchange Policy","content":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla auctor aliquam tortor at suscipit. Etiam accumsan, est id vehicula cursus, eros ligula suscipit massa, sed auctor felis mi eu massa. Sed vulputate nisi nibh, vel maximus velit auctor nec. Integer consectetur elementum turpis, nec fermentum ipsum tempor quis. Praesent a quam congue, egestas erat sit amet, finibus justo. Quisque viverra neque vehicula eros gravida ultricies. Ut lacinia enim nec consequat tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus ultricies ornare feugiat. Donec vitae rhoncus sapien, ac aliquet nunc."}]',
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
