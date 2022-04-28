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
        $productTopCarousel  = DB::table('media_files')->insertGetId( ['file_name' => 'bg-top-carousel', 'file_path' => 'freshen/shop-items/slider1.jpg', 'file_type' => 'image/jpg', 'file_extension' => 'jpg']);
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
                ];
            })
            ->create();
//        Setting page search product
        $settings = [
            [
                'name'=>'fs_search_layout',
                'val'=>'2'
            ],
            [
                'name'=>'fs_search_item_layout',
                'val'=>'gird'
            ],
            [
                'name'=>'fs_search_top_product_ids',
                'val'=>Product::where('status','publish')->limit(6)->inRandomOrder()->get('id')->implode('id',',')
            ],
            [
                'name'=>'fs_search_top_category_ids',
                'val'=>ProductCategory::where('status','publish')->limit(6)->inRandomOrder()->get('id')->implode('id',',')
            ],
            [
                'name'=>'fs_search_top_carousel',
                'val'=>[
                    ["title"=>"<span class=\"fwb\">Healthy Food</span><br><span class=\"text-thm fw400\">&amp; Organic Market</span>",
                        "sub_title"=>"All natural products",
                        "desc"=>"<span class=\"fwb\">Organic food</span> is food produced by methods that comply with the <br> standards of organic farming.",
                        "button_text"=>"SHOP NOW",
                        "button_link"=>"#",
                        "image_id"=>$productTopCarousel,
                        "order"=>1
                    ],
                    ["title"=>"<span class=\"fwb\">Get fresher food</span><br><span class=\"text-thm fw400\">&amp; every days</span>",
                        "sub_title"=>"All natural products",
                        "desc"=>"<span class=\"fwb\">Organic food</span> is food produced by methods that comply with the <br> standards of organic farming.",
                        "button_text"=>"SHOP NOW",
                        "button_link"=>"#",
                        "image_id"=>$productTopCarousel,
                        "order"=>2
                    ]
                ]
            ],
            [
                'name'=>'fs_products_sidebar',
                'val'=>[
                    ["title"=>"PRODUCT CATEGORIES","content"=>null,"attr"=>null,"type"=>"category"],
                    ["title"=>"FILTER BY COLOR","content"=>null,"attr"=>"1","type"=>"attr"],
                    ["title"=>"TRENDING TAGS","content"=>null,"attr"=>null,"type"=>"tag"],
                    [
                        "title"=>null,
                        "content"=>"<div class=\"thumb\"><img src='/themes/Freshen/images/banner/4.jpg' alt=\"4.jpg\"></div><div class='details style2'><p class=\"para\">Tasty Healthy</p><h2 class=\"title\">Fresh Vegetables</h2><a href='/product' class=\"shop_btn style2\">SHOP NOW</a></div>",
                        "attr"=>null,
                        "type"=>"content_text"
                    ]

                ]
            ]
        ];
        setting_update_items($settings);

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
