<?php
namespace Themes\Demus\Database\Seeders;
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
            'image-1'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-1', 'file_path' => 'demus/shop/product-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-2'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-2', 'file_path' => 'demus/shop/product-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-3'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-3', 'file_path' => 'demus/shop/product-3.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-4'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-4', 'file_path' => 'demus/shop/product-4.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-5'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-5', 'file_path' => 'demus/shop/product-5.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-6'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-6', 'file_path' => 'demus/shop/product-6.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-7'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-7', 'file_path' => 'demus/shop/product-7.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-8'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-8', 'file_path' => 'demus/shop/product-8.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-9'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-9', 'file_path' => 'demus/shop/product-9.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-10'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-10', 'file_path' => 'demus/shop/product-10.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-11'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-11', 'file_path' => 'demus/shop/product-11.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-12'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-12', 'file_path' => 'demus/shop/product-12.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-13'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-13', 'file_path' => 'demus/shop/product-13.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-14'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-14', 'file_path' => 'demus/shop/product-14.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-15'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-15', 'file_path' => 'demus/shop/product-15.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-16'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-16', 'file_path' => 'demus/shop/product-16.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-17'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-17', 'file_path' => 'demus/shop/product-17.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-18'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-18', 'file_path' => 'demus/shop/product-18.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-19'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-19', 'file_path' => 'demus/shop/product-19.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-20'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-20', 'file_path' => 'demus/shop/product-20.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-21'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-21', 'file_path' => 'demus/shop/product-21.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-22'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-22', 'file_path' => 'demus/shop/product-22.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-23'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-23', 'file_path' => 'demus/shop/product-23.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-24'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-24', 'file_path' => 'demus/shop/product-24.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-25'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-25', 'file_path' => 'demus/shop/product-25.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-26'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-26', 'file_path' => 'demus/shop/product-26.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-27'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-27', 'file_path' => 'demus/shop/product-27.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-28'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-28', 'file_path' => 'demus/shop/product-28.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-29'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-29', 'file_path' => 'demus/shop/product-29.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-30'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-30', 'file_path' => 'demus/shop/product-30.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
        ];
        $productGallery = [
            'image-1'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'gallery-image-1', 'file_path' => 'demus/shop/product-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-2'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'gallery-image-2', 'file_path' => 'demus/shop/product-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-3'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'gallery-image-3', 'file_path' => 'demus/shop/product-3.png', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-4'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'gallery-image-4', 'file_path' => 'demus/shop/product-4.png', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
        ];
        $brandName = [
            "Ashley",
            'Wicked',
            "Yann"
        ];
        $productName = [
            'Alex lounge chair',
            "Alex lounge chair",
            "Alex lounge chair",
            "Alex lounge chair",
            "Alex lounge chair",
            "Alex lounge chair",
            "Alex lounge chair",
            "Alex lounge chair",
            "Alex lounge chair",
            "Alex lounge chair",
            "Wicked lounge rattan",
            "Wicked lounge rattan",
            "Wicked lounge rattan",
            "Wicked lounge rattan",
            "Wicked lounge rattan",
            "Wicked lounge rattan",
            "Wicked lounge rattan",
            "Wicked lounge rattan",
            "Wicked lounge rattan",
            "Wicked lounge rattan",
            "Yann oak base",
            "Yann oak base",
            "Yann oak base",
            "Yann oak base",
            "Yann oak base",
            "Yann oak base",
            "Yann oak base",
            "Yann oak base",
            "Yann oak base",
            "Yann oak base",
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
                }                return [
                    'title'=>$productName[$sequent->index],
                    'brand_id'=>$productBrand->random(1)->first()->id,
                    'image_id'=> \Arr::random($productImage),
                    'gallery'     => implode(',',$productGallery),
                    'product_type'=> $product_type,
                ];
            })
            ->create();

    }

    public function seedSettings(){
        $settings = [
            'product_page_search_title'         =>'Shop',
            'product_policies'                  =>'[{"title":"Shipping Policy","content":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla auctor aliquam tortor at suscipit. Etiam accumsan, est id vehicula cursus, eros ligula suscipit massa, sed auctor felis mi eu massa. Sed vulputate nisi nibh, vel maximus velit auctor nec. Integer consectetur elementum turpis, nec fermentum ipsum tempor quis. Praesent a quam congue, egestas erat sit amet, finibus justo. Quisque viverra neque vehicula eros gravida ultricies. Ut lacinia enim nec consequat tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus ultricies ornare feugiat. Donec vitae rhoncus sapien, ac aliquet nunc."},{"title":"Refund Policy","content":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla auctor aliquam tortor at suscipit. Etiam accumsan, est id vehicula cursus, eros ligula suscipit massa, sed auctor felis mi eu massa. Sed vulputate nisi nibh, vel maximus velit auctor nec. Integer consectetur elementum turpis, nec fermentum ipsum tempor quis. Praesent a quam congue, egestas erat sit amet, finibus justo. Quisque viverra neque vehicula eros gravida ultricies. Ut lacinia enim nec consequat tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus ultricies ornare feugiat. Donec vitae rhoncus sapien, ac aliquet nunc."},{"title":"Cancellation \/ Return \/ Exchange Policy","content":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla auctor aliquam tortor at suscipit. Etiam accumsan, est id vehicula cursus, eros ligula suscipit massa, sed auctor felis mi eu massa. Sed vulputate nisi nibh, vel maximus velit auctor nec. Integer consectetur elementum turpis, nec fermentum ipsum tempor quis. Praesent a quam congue, egestas erat sit amet, finibus justo. Quisque viverra neque vehicula eros gravida ultricies. Ut lacinia enim nec consequat tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus ultricies ornare feugiat. Donec vitae rhoncus sapien, ac aliquet nunc."}]',
            'product_enable_review'             => 1,
            'guest_checkout'                    => 1,
            'email_c_new_order_enable'          => 1,
            'email_c_new_order_subject'         => __("Thanks for shopping with us"),

            'email_c_completed_order_enable'    => 1,
            'email_c_completed_order_subject'   => __("Order Completed #[order_number]"),

            'email_c_cancelled_order_enable'    => 1,
            'email_c_cancelled_order_subject'   => __("Order Cancelled #[order_number]"),

            'email_c_refunded_order_enable'     => 1,
            'email_c_refunded_order_subject'    => __("Order Refunded #[order_number]"),

            'email_v_new_order_enable'          => 1,
            'email_v_new_order_subject'         => __("[site_title]: New order #[order_number]"),
            'email_v_completed_order_enable'    => 1,
            'email_v_completed_order_subject'   => __("Order Completed #[order_number]"),
            'email_v_cancelled_order_enable'    => 1,
            'email_v_cancelled_order_subject'   => __("Order Cancelled #[order_number]"),
            'email_v_refunded_order_enable'     => 1,
            'email_v_refunded_order_subject'    => __("Order Refunded #[order_number]"),

            'email_a_new_order_enable'          => 1,
            'email_a_new_order_subject'         => __("[site_title]: New order #[order_number]"),
            'email_a_completed_order_enable'    => 1,
            'email_a_completed_order_subject'   => __("Order Completed #[order_number]"),
            'email_a_cancelled_order_enable'    => 1,
            'email_a_cancelled_order_subject'   => __("Order Cancelled #[order_number]"),
            'email_a_refunded_order_enable'     => 1,
            'email_a_refunded_order_subject'    => __("Order Refunded #[order_number]"),
        ];
        foreach ($settings as $setting=>$val){
            setting_update_item($setting,$val);
        }
    }
}
