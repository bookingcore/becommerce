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
        $productImage = [
            'image-1'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-1', 'file_path' => 'demo/templates/product-image-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-2'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-2', 'file_path' => 'demo/templates/product-image-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-3'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-3', 'file_path' => 'demo/templates/product-image-3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-4'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-4', 'file_path' => 'demo/templates/product-image-4.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-5'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-5', 'file_path' => 'demo/templates/product-image-5.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-6'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-6', 'file_path' => 'demo/templates/product-image-6.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-7'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-7', 'file_path' => 'demo/templates/product-image-7.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-8'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-8', 'file_path' => 'demo/templates/product-image-8.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
        ];
        $productGallery = [
            'image-1'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'gallery-image-1', 'file_path' => 'demo/templates/gallery-image-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-2'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'gallery-image-2', 'file_path' => 'demo/templates/gallery-image-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-3'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'gallery-image-3', 'file_path' => 'demo/templates/gallery-image-3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-4'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'gallery-image-4', 'file_path' => 'demo/templates/gallery-image-4.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
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

//        //Create variable product
//        $variable_id_1 = DB::table('product_variations')->insertGetId(
//            [
//                'product_id'    =>  $id_6,
//                'price'         =>  '22',
//                'stock_status'  =>  'in',
//                'active'        =>  '1',
//            ]
//        );
//        $variable_id_2 = DB::table('product_variations')->insertGetId(
//            [
//                'product_id'    =>  $id_6,
//                'price'         =>  '22',
//                'stock_status'  =>  'in',
//                'active'        =>  '1',
//            ]
//        );
//        $variable_id_3 = DB::table('product_variations')->insertGetId(
//            [
//                'product_id'    =>  $id_6,
//                'price'         =>  '22',
//                'stock_status'  =>  'in',
//                'active'        =>  '1',
//            ]
//        );
//        $variable_id_4 = DB::table('product_variations')->insertGetId(
//            [
//                'product_id'    =>  $id_6,
//                'price'         =>  '20',
//                'stock_status'  =>  'in',
//                'active'        =>  '1',
//            ]
//        );
//        $variable_id_5 = DB::table('product_variations')->insertGetId(
//            [
//                'product_id'    =>  $id_6,
//                'price'         =>  '20',
//                'stock_status'  =>  'in',
//                'active'        =>  '1',
//            ]
//        );
//        $variable_id_6 = DB::table('product_variations')->insertGetId(
//            [
//                'product_id'    =>  $id_6,
//                'price'         =>  '20',
//                'stock_status'  =>  'in',
//                'active'        =>  '1',
//            ]
//        );
//        //End create variable product
//
//        //Create variable product term
//        DB::table('product_variation_term')->insert(
//            [
//                [
//                    'product_id'    =>  $id_6,
//                    'variation_id'  =>  $variable_id_6,
//                    'term_id'       =>  $term[0],
//                    'create_user'   =>  1
//                ],
//                [
//                    'product_id'    =>  $id_6,
//                    'variation_id'  =>  $variable_id_6,
//                    'term_id'       =>  $term[3],
//                    'create_user'   =>  1
//                ],
//                [
//                    'product_id'    =>  $id_6,
//                    'variation_id'  =>  $variable_id_5,
//                    'term_id'       =>  $term[0],
//                    'create_user'   =>  1
//                ],
//                [
//                    'product_id'    =>  $id_6,
//                    'variation_id'  =>  $variable_id_5,
//                    'term_id'       =>  $term[4],
//                    'create_user'   =>  1
//                ],
//                [
//                    'product_id'    =>  $id_6,
//                    'variation_id'  =>  $variable_id_4,
//                    'term_id'       =>  $term[0],
//                    'create_user'   =>  1
//                ],
//                [
//                    'product_id'    =>  $id_6,
//                    'variation_id'  =>  $variable_id_4,
//                    'term_id'       =>  $term[5],
//                    'create_user'   =>  1
//                ],
//                [
//                    'product_id'    =>  $id_6,
//                    'variation_id'  =>  $variable_id_3,
//                    'term_id'       =>  $term[1],
//                    'create_user'   =>  1
//                ],
//                [
//                    'product_id'    =>  $id_6,
//                    'variation_id'  =>  $variable_id_3,
//                    'term_id'       =>  $term[3],
//                    'create_user'   =>  1
//                ],
//                [
//                    'product_id'    =>  $id_6,
//                    'variation_id'  =>  $variable_id_2,
//                    'term_id'       =>  $term[1],
//                    'create_user'   =>  1
//                ],
//                [
//                    'product_id'    =>  $id_6,
//                    'variation_id'  =>  $variable_id_2,
//                    'term_id'       =>  $term[4],
//                    'create_user'   =>  1
//                ],
//                [
//                    'product_id'    =>  $id_6,
//                    'variation_id'  =>  $variable_id_1,
//                    'term_id'       =>  $term[1],
//                    'create_user'   =>  1
//                ],
//                [
//                    'product_id'    =>  $id_6,
//                    'variation_id'  =>  $variable_id_1,
//                    'term_id'       =>  $term[5],
//                    'create_user'   =>  1
//                ],
//            ]
//        );





        //product search Sliders
        $p_slider = [
            'image-1'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-banner-1', 'file_path' => 'demo/templates/product-banner-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-2'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-banner-2', 'file_path' => 'demo/templates/product-banner-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
        ];
        $ads_image = DB::table('media_files')->insertGetId( ['file_name' => 'ads-image', 'file_path' => 'demo/templates/ads-image.png', 'file_type' => 'image/png', 'file_extension' => 'png']);
        DB::table('core_settings')->insertGetId([
            'name'  =>  'product_page_search_title',
            'group' =>  'product',
            'val'   =>  'Shop'
        ]);
        DB::table('core_settings')->insertGetId([
            'name'  =>  'list_sliders',
            'group' =>  'product',
            'val'   =>  '[{"image_id":"'.$p_slider['image-1'].'","title":"banner 1","content":null},{"image_id":"'.$p_slider['image-2'].'","title":"Banner 2","content":null}]'
        ]);
        DB::table('core_settings')->insertGetId([
            'name'  =>  'product_policies',
            'group' =>  'product',
            'val'   =>  '[{"title":"Shipping Policy","content":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla auctor aliquam tortor at suscipit. Etiam accumsan, est id vehicula cursus, eros ligula suscipit massa, sed auctor felis mi eu massa. Sed vulputate nisi nibh, vel maximus velit auctor nec. Integer consectetur elementum turpis, nec fermentum ipsum tempor quis. Praesent a quam congue, egestas erat sit amet, finibus justo. Quisque viverra neque vehicula eros gravida ultricies. Ut lacinia enim nec consequat tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus ultricies ornare feugiat. Donec vitae rhoncus sapien, ac aliquet nunc."},{"title":"Refund Policy","content":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla auctor aliquam tortor at suscipit. Etiam accumsan, est id vehicula cursus, eros ligula suscipit massa, sed auctor felis mi eu massa. Sed vulputate nisi nibh, vel maximus velit auctor nec. Integer consectetur elementum turpis, nec fermentum ipsum tempor quis. Praesent a quam congue, egestas erat sit amet, finibus justo. Quisque viverra neque vehicula eros gravida ultricies. Ut lacinia enim nec consequat tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus ultricies ornare feugiat. Donec vitae rhoncus sapien, ac aliquet nunc."},{"title":"Cancellation \/ Return \/ Exchange Policy","content":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla auctor aliquam tortor at suscipit. Etiam accumsan, est id vehicula cursus, eros ligula suscipit massa, sed auctor felis mi eu massa. Sed vulputate nisi nibh, vel maximus velit auctor nec. Integer consectetur elementum turpis, nec fermentum ipsum tempor quis. Praesent a quam congue, egestas erat sit amet, finibus justo. Quisque viverra neque vehicula eros gravida ultricies. Ut lacinia enim nec consequat tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus ultricies ornare feugiat. Donec vitae rhoncus sapien, ac aliquet nunc."}]'
        ]);
        DB::table('core_settings')->insertGetId([
            'name'  =>  'shipping_information',
            'group' =>  'product',
            'val'   =>  '<div class="col-product-sidebar-item product-sidebar-shipping">
    <ul class="product-sidebar-shipping-info">
        <li><i class="icon-network"></i>Shipping worldwide</li>
        <li><i class="icon-3d-rotate"></i>Free 7-day return if eligible, so easy </li>
        <li><i class="icon-receipt"></i>Supplier give bills for this product.</li>
        <li><i class="icon-credit-card"></i>Pay online or when receiving goods</li>
    </ul>
</div>'
        ]);
        DB::table('core_settings')->insertGetId([
            'name'  =>  'ads_image',
            'group' =>  'product',
            'val'   =>  $ads_image
        ]);

    }
}
