<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        //product search Sliders
        $p_slider = [
            'image-1'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-banner-1', 'file_path' => 'demo/templates/product-banner-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-2'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-banner-2', 'file_path' => 'demo/templates/product-banner-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
        ];
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

        $list_brands = [];
        $list_brands["galaxy"] = DB::table('product_brand')->insertGetId([
            'name'       => "Galaxy",
            'slug'       => "galaxy",
            'status'     => "publish",
            'create_user'=> "1",
        ] );
        $list_brands["casio"] = DB::table('product_brand')->insertGetId([
            'name'       => "Casio",
            'slug'       => "casio",
            'status'     => "publish",
            'create_user'=> "1",
        ] );
        $list_brands["electrolux"] = DB::table('product_brand')->insertGetId([
            'name'       => "Electrolux",
            'slug'       => "electrolux",
            'status'     => "publish",
            'create_user'=> "1",
        ] );
        $list_brands["amcrest"] = DB::table('product_brand')->insertGetId([
                'name'       => "Amcrest",
                'slug'       => "amcrest",
                'status'     => "publish",
                'create_user'=> "1"
        ] );
        $list_brands["adidas"] = DB::table('product_brand')->insertGetId([
            'name'       => "Adidas",
            'slug'       => "adidas",
            'status'     => "publish",
            'create_user'=> "1",
        ] );
        $list_brands["sony"] = DB::table('product_brand')->insertGetId([
            'name'       => "Sony",
            'slug'       => "sony",
            'status'     => "publish",
            'create_user'=> "1",
        ] );
        $list_brands["xbox"] = DB::table('product_brand')->insertGetId([
            'name'       => "XBox",
            'slug'       => "xbox",
            'status'     => "publish",
            'create_user'=> "1",
        ] );
        $list_brands["samsung"] = DB::table('product_brand')->insertGetId([
            'name'       => "Samsung",
            'slug'       => "samsung",
            'status'     => "publish",
            'create_user'=> "1",
        ] );
        $list_brands["syma"] = DB::table('product_brand')->insertGetId([
            'name'       => "Syma",
            'slug'       => "syma",
            'status'     => "publish",
            'create_user'=> "1",
        ] );
        $list_brands["apple"] = DB::table('product_brand')->insertGetId([
            'name'       => "Apple",
            'slug'       => "apple",
            'status'     => "publish",
            'create_user'=> "1",
        ] );
        $list_brands["asus"] = DB::table('product_brand')->insertGetId([
            'name'       => "Asus",
            'slug'       => "asus",
            'status'     => "publish",
            'create_user'=> "1",
        ] );

        //Gallery Image
        $gallery_image = [
            'image-1'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'gallery-image-1', 'file_path' => 'demo/templates/gallery-image-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-2'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'gallery-image-2', 'file_path' => 'demo/templates/gallery-image-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-3'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'gallery-image-3', 'file_path' => 'demo/templates/gallery-image-3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-4'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'gallery-image-4', 'file_path' => 'demo/templates/gallery-image-4.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
        ];

        //Product Image
        $product_image = [
            'image-1'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-1', 'file_path' => 'demo/templates/product-image-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-2'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-2', 'file_path' => 'demo/templates/product-image-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-3'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-3', 'file_path' => 'demo/templates/product-image-3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-4'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-4', 'file_path' => 'demo/templates/product-image-4.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-5'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-5', 'file_path' => 'demo/templates/product-image-5.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-6'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-6', 'file_path' => 'demo/templates/product-image-6.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-7'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-7', 'file_path' => 'demo/templates/product-image-7.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-8'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-8', 'file_path' => 'demo/templates/product-image-8.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-9'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-9', 'file_path' => 'demo/templates/product-image-9.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-10'  =>  DB::table('media_files')->insertGetId( ['file_name' => 'product-image-10', 'file_path' => 'demo/templates/product-image-10.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
        ];

        $list_products = [];
        $id_1 = DB::table('products')->insertGetId([
            'title'       => "Sleeve Linen Blend Caro Pane Shirt",
            'slug'        => "sleeve-linen-blend-caro-pane-shirt",
            'content'     => '<p><strong>Embodying the Raw, Wayward Spirit of Rock \'N\' Roll</strong></p><p>Embodying the raw, wayward spirit of rock ‘n’ roll, the Kilburn portable active stereo speaker takes the unmistakable look and sound of Marshall, unplugs the chords, and takes the show on the road.</p><p> </p><p>Weighing in under 7 pounds, the Kilburn is a lightweight piece of vintage styled engineering. Setting the bar as one of the loudest speakers in its class, the Kilburn is a compact, stout-hearted hero with a well-balanced audio which boasts a clear midrange and extended highs for a sound that is both articulate and pronounced. The analogue knobs allow you to fine tune the controls to your personal preferences while the guitar-influenced leather strap enables easy and stylish travel.</p><p><img src="/uploads/demo/templates/post-image.jpg" alt="Embodying the Raw, Wayward Spirit of Rock \'N\' Roll" width="654" height="205" /></p><p>What do you get</p><p>Sound of Marshall, unplugs the chords, and takes the show on the road.</p><p>Weighing in under 7 pounds, the Kilburn is a lightweight piece of vintage styled engineering. Setting the bar as one of the loudest speakers in its class, the Kilburn is a compact, stout-hearted hero with a well-balanced audio which boasts a clear midrange and extended highs for a sound that is both articulate and pronounced. The analogue knobs allow you to fine tune the controls to your personal preferences while the guitar-influenced leather strap enables easy and stylish travel.</p><p> </p><p>The FM radio is perhaps gone for good, the assumption apparently being that the jury has ruled in favor of streaming over the internet. The IR blaster is another feature due for retirement – the S6 had it, then the Note5 didn’t, and now with the S7 the trend is clear.</p><p> </p><p>Perfectly Done</p><p>Meanwhile, the IP68 water resistance has improved from the S5, allowing submersion of up to five feet for 30 minutes, plus there’s no annoying flap covering the charging port</p><p> </p><ul><li>No FM radio (except for T-Mobile units in the US, so far)</li><li>No IR blaster</li><li>No stereo speakers</li></ul><p>If you’ve taken the phone for a plunge in the bath, you’ll need to dry the charging port before plugging in. Samsung hasn’t reinvented the wheel with the design of the Galaxy S7, but it didn’t need to. The Gala S6 was an excellently styled device, and the S7 has managed to improve on that.</p><div><div class="gtx-trans-icon"> </div></div>',
            'image_id'    => $product_image['image-1'],
            'short_desc'  => '<ul><li>Unrestrained and portable active stereo speaker</li><li>Free from the confines of wires and chords</li><li>20 hours of portable capabilities</li><li>Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li><li>3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li></ul>',
            'brand_id'    => $list_brands["adidas"],
            'gallery'     => implode(',',$gallery_image),
            'price'       => '39.99',
            'sale_price'  => '29.39',
            'status'      => 'publish',
            'stock_status'=> 'in',
            'product_type'=> 'simple',
            'create_user' => '1'
        ] );
        $id_2 = DB::table('products')->insertGetId([
            'title'       => "Paul’s Smith Sneaker InWhite Color",
            'slug'        => "pauls-smith-sneaker-inwhite-color",
            'content'     => '<p><strong>Embodying the Raw, Wayward Spirit of Rock \'N\' Roll</strong></p><p>Embodying the raw, wayward spirit of rock ‘n’ roll, the Kilburn portable active stereo speaker takes the unmistakable look and sound of Marshall, unplugs the chords, and takes the show on the road.</p><p> </p><p>Weighing in under 7 pounds, the Kilburn is a lightweight piece of vintage styled engineering. Setting the bar as one of the loudest speakers in its class, the Kilburn is a compact, stout-hearted hero with a well-balanced audio which boasts a clear midrange and extended highs for a sound that is both articulate and pronounced. The analogue knobs allow you to fine tune the controls to your personal preferences while the guitar-influenced leather strap enables easy and stylish travel.</p><p><img src="/uploads/demo/templates/post-image.jpg" alt="Embodying the Raw, Wayward Spirit of Rock \'N\' Roll" width="654" height="205" /></p><p>What do you get</p><p>Sound of Marshall, unplugs the chords, and takes the show on the road.</p><p>Weighing in under 7 pounds, the Kilburn is a lightweight piece of vintage styled engineering. Setting the bar as one of the loudest speakers in its class, the Kilburn is a compact, stout-hearted hero with a well-balanced audio which boasts a clear midrange and extended highs for a sound that is both articulate and pronounced. The analogue knobs allow you to fine tune the controls to your personal preferences while the guitar-influenced leather strap enables easy and stylish travel.</p><p> </p><p>The FM radio is perhaps gone for good, the assumption apparently being that the jury has ruled in favor of streaming over the internet. The IR blaster is another feature due for retirement – the S6 had it, then the Note5 didn’t, and now with the S7 the trend is clear.</p><p> </p><p>Perfectly Done</p><p>Meanwhile, the IP68 water resistance has improved from the S5, allowing submersion of up to five feet for 30 minutes, plus there’s no annoying flap covering the charging port</p><p> </p><ul><li>No FM radio (except for T-Mobile units in the US, so far)</li><li>No IR blaster</li><li>No stereo speakers</li></ul><p>If you’ve taken the phone for a plunge in the bath, you’ll need to dry the charging port before plugging in. Samsung hasn’t reinvented the wheel with the design of the Galaxy S7, but it didn’t need to. The Gala S6 was an excellently styled device, and the S7 has managed to improve on that.</p><div><div class="gtx-trans-icon"> </div></div>',
            'image_id'    => $product_image['image-2'],
            'short_desc'  => '<ul><li>Unrestrained and portable active stereo speaker</li><li>Free from the confines of wires and chords</li><li>20 hours of portable capabilities</li><li>Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li><li>3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li></ul>',
            'brand_id'    => $list_brands["adidas"],
            'gallery'     => implode(',',$gallery_image),
            'price'       => '75.44',
            'sale_price'  => null,
            'status'      => 'publish',
            'stock_status'=> 'in',
            'product_type'=> 'simple',
            'create_user' => '1'
        ] );
        $id_3 = DB::table('products')->insertGetId([
            'title'       => "Herschel Leather Duffle Bag In Brown Color",
            'slug'        => "herschel-leather-duffle-bag-in-brown-color",
            'content'     => '<p><strong>Embodying the Raw, Wayward Spirit of Rock \'N\' Roll</strong></p><p>Embodying the raw, wayward spirit of rock ‘n’ roll, the Kilburn portable active stereo speaker takes the unmistakable look and sound of Marshall, unplugs the chords, and takes the show on the road.</p><p> </p><p>Weighing in under 7 pounds, the Kilburn is a lightweight piece of vintage styled engineering. Setting the bar as one of the loudest speakers in its class, the Kilburn is a compact, stout-hearted hero with a well-balanced audio which boasts a clear midrange and extended highs for a sound that is both articulate and pronounced. The analogue knobs allow you to fine tune the controls to your personal preferences while the guitar-influenced leather strap enables easy and stylish travel.</p><p><img src="/uploads/demo/templates/post-image.jpg" alt="Embodying the Raw, Wayward Spirit of Rock \'N\' Roll" width="654" height="205" /></p><p>What do you get</p><p>Sound of Marshall, unplugs the chords, and takes the show on the road.</p><p>Weighing in under 7 pounds, the Kilburn is a lightweight piece of vintage styled engineering. Setting the bar as one of the loudest speakers in its class, the Kilburn is a compact, stout-hearted hero with a well-balanced audio which boasts a clear midrange and extended highs for a sound that is both articulate and pronounced. The analogue knobs allow you to fine tune the controls to your personal preferences while the guitar-influenced leather strap enables easy and stylish travel.</p><p> </p><p>The FM radio is perhaps gone for good, the assumption apparently being that the jury has ruled in favor of streaming over the internet. The IR blaster is another feature due for retirement – the S6 had it, then the Note5 didn’t, and now with the S7 the trend is clear.</p><p> </p><p>Perfectly Done</p><p>Meanwhile, the IP68 water resistance has improved from the S5, allowing submersion of up to five feet for 30 minutes, plus there’s no annoying flap covering the charging port</p><p> </p><ul><li>No FM radio (except for T-Mobile units in the US, so far)</li><li>No IR blaster</li><li>No stereo speakers</li></ul><p>If you’ve taken the phone for a plunge in the bath, you’ll need to dry the charging port before plugging in. Samsung hasn’t reinvented the wheel with the design of the Galaxy S7, but it didn’t need to. The Gala S6 was an excellently styled device, and the S7 has managed to improve on that.</p><div><div class="gtx-trans-icon"> </div></div>',
            'image_id'    => $product_image['image-3'],
            'short_desc'  => '<ul><li>Unrestrained and portable active stereo speaker</li><li>Free from the confines of wires and chords</li><li>20 hours of portable capabilities</li><li>Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li><li>3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li></ul>',
            'brand_id'    => $list_brands["galaxy"],
            'gallery'     => implode(',',$gallery_image),
            'price'       => '125.30',
            'sale_price'  => null,
            'status'      => 'publish',
            'stock_status'=> 'in',
            'product_type'=> 'simple',
            'create_user' => '1'
        ] );
        $id_4 = DB::table('products')->insertGetId([
            'title'       => "Unero Military Classical Backpack",
            'slug'        => "unero-military-classical-backpack",
            'content'     => '<p><strong>Embodying the Raw, Wayward Spirit of Rock \'N\' Roll</strong></p><p>Embodying the raw, wayward spirit of rock ‘n’ roll, the Kilburn portable active stereo speaker takes the unmistakable look and sound of Marshall, unplugs the chords, and takes the show on the road.</p><p> </p><p>Weighing in under 7 pounds, the Kilburn is a lightweight piece of vintage styled engineering. Setting the bar as one of the loudest speakers in its class, the Kilburn is a compact, stout-hearted hero with a well-balanced audio which boasts a clear midrange and extended highs for a sound that is both articulate and pronounced. The analogue knobs allow you to fine tune the controls to your personal preferences while the guitar-influenced leather strap enables easy and stylish travel.</p><p><img src="/uploads/demo/templates/post-image.jpg" alt="Embodying the Raw, Wayward Spirit of Rock \'N\' Roll" width="654" height="205" /></p><p>What do you get</p><p>Sound of Marshall, unplugs the chords, and takes the show on the road.</p><p>Weighing in under 7 pounds, the Kilburn is a lightweight piece of vintage styled engineering. Setting the bar as one of the loudest speakers in its class, the Kilburn is a compact, stout-hearted hero with a well-balanced audio which boasts a clear midrange and extended highs for a sound that is both articulate and pronounced. The analogue knobs allow you to fine tune the controls to your personal preferences while the guitar-influenced leather strap enables easy and stylish travel.</p><p> </p><p>The FM radio is perhaps gone for good, the assumption apparently being that the jury has ruled in favor of streaming over the internet. The IR blaster is another feature due for retirement – the S6 had it, then the Note5 didn’t, and now with the S7 the trend is clear.</p><p> </p><p>Perfectly Done</p><p>Meanwhile, the IP68 water resistance has improved from the S5, allowing submersion of up to five feet for 30 minutes, plus there’s no annoying flap covering the charging port</p><p> </p><ul><li>No FM radio (except for T-Mobile units in the US, so far)</li><li>No IR blaster</li><li>No stereo speakers</li></ul><p>If you’ve taken the phone for a plunge in the bath, you’ll need to dry the charging port before plugging in. Samsung hasn’t reinvented the wheel with the design of the Galaxy S7, but it didn’t need to. The Gala S6 was an excellently styled device, and the S7 has managed to improve on that.</p><div><div class="gtx-trans-icon"> </div></div>',
            'image_id'    => $product_image['image-4'],
            'short_desc'  => '<ul><li>Unrestrained and portable active stereo speaker</li><li>Free from the confines of wires and chords</li><li>20 hours of portable capabilities</li><li>Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li><li>3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li></ul>',
            'brand_id'    => $list_brands["galaxy"],
            'gallery'     => implode(',',$gallery_image),
            'price'       => '42.39',
            'sale_price'  => null,
            'status'      => 'publish',
            'stock_status'=> 'in',
            'product_type'=> 'simple',
            'create_user' => '1'
        ] );
        $id_5 = DB::table('products')->insertGetId([
            'title'       => "Rayban Rounded Sunglass Brown Color",
            'slug'        => "rayban-rounded-sunglass-brown-color",
            'content'     => '<p><strong>Embodying the Raw, Wayward Spirit of Rock \'N\' Roll</strong></p><p>Embodying the raw, wayward spirit of rock ‘n’ roll, the Kilburn portable active stereo speaker takes the unmistakable look and sound of Marshall, unplugs the chords, and takes the show on the road.</p><p> </p><p>Weighing in under 7 pounds, the Kilburn is a lightweight piece of vintage styled engineering. Setting the bar as one of the loudest speakers in its class, the Kilburn is a compact, stout-hearted hero with a well-balanced audio which boasts a clear midrange and extended highs for a sound that is both articulate and pronounced. The analogue knobs allow you to fine tune the controls to your personal preferences while the guitar-influenced leather strap enables easy and stylish travel.</p><p><img src="/uploads/demo/templates/post-image.jpg" alt="Embodying the Raw, Wayward Spirit of Rock \'N\' Roll" width="654" height="205" /></p><p>What do you get</p><p>Sound of Marshall, unplugs the chords, and takes the show on the road.</p><p>Weighing in under 7 pounds, the Kilburn is a lightweight piece of vintage styled engineering. Setting the bar as one of the loudest speakers in its class, the Kilburn is a compact, stout-hearted hero with a well-balanced audio which boasts a clear midrange and extended highs for a sound that is both articulate and pronounced. The analogue knobs allow you to fine tune the controls to your personal preferences while the guitar-influenced leather strap enables easy and stylish travel.</p><p> </p><p>The FM radio is perhaps gone for good, the assumption apparently being that the jury has ruled in favor of streaming over the internet. The IR blaster is another feature due for retirement – the S6 had it, then the Note5 didn’t, and now with the S7 the trend is clear.</p><p> </p><p>Perfectly Done</p><p>Meanwhile, the IP68 water resistance has improved from the S5, allowing submersion of up to five feet for 30 minutes, plus there’s no annoying flap covering the charging port</p><p> </p><ul><li>No FM radio (except for T-Mobile units in the US, so far)</li><li>No IR blaster</li><li>No stereo speakers</li></ul><p>If you’ve taken the phone for a plunge in the bath, you’ll need to dry the charging port before plugging in. Samsung hasn’t reinvented the wheel with the design of the Galaxy S7, but it didn’t need to. The Gala S6 was an excellently styled device, and the S7 has managed to improve on that.</p><div><div class="gtx-trans-icon"> </div></div>',
            'image_id'    => $product_image['image-5'],
            'short_desc'  => '<ul><li>Unrestrained and portable active stereo speaker</li><li>Free from the confines of wires and chords</li><li>20 hours of portable capabilities</li><li>Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li><li>3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li></ul>',
            'brand_id'    => $list_brands["casio"],
            'gallery'     => implode(',',$gallery_image),
            'price'       => '125.89',
            'sale_price'  => null,
            'status'      => 'publish',
            'stock_status'=> 'in',
            'product_type'=> 'simple',
            'create_user' => '1'
        ] );
        $id_6 = DB::table('products')->insertGetId([
            'title'       => "Men’s Sports Runnning Swim Board Shorts",
            'slug'        => "mens-sports-runnning-swim-board-shorts",
            'content'     => '<p><strong>Embodying the Raw, Wayward Spirit of Rock \'N\' Roll</strong></p><p>Embodying the raw, wayward spirit of rock ‘n’ roll, the Kilburn portable active stereo speaker takes the unmistakable look and sound of Marshall, unplugs the chords, and takes the show on the road.</p><p> </p><p>Weighing in under 7 pounds, the Kilburn is a lightweight piece of vintage styled engineering. Setting the bar as one of the loudest speakers in its class, the Kilburn is a compact, stout-hearted hero with a well-balanced audio which boasts a clear midrange and extended highs for a sound that is both articulate and pronounced. The analogue knobs allow you to fine tune the controls to your personal preferences while the guitar-influenced leather strap enables easy and stylish travel.</p><p><img src="/uploads/demo/templates/post-image.jpg" alt="Embodying the Raw, Wayward Spirit of Rock \'N\' Roll" width="654" height="205" /></p><p>What do you get</p><p>Sound of Marshall, unplugs the chords, and takes the show on the road.</p><p>Weighing in under 7 pounds, the Kilburn is a lightweight piece of vintage styled engineering. Setting the bar as one of the loudest speakers in its class, the Kilburn is a compact, stout-hearted hero with a well-balanced audio which boasts a clear midrange and extended highs for a sound that is both articulate and pronounced. The analogue knobs allow you to fine tune the controls to your personal preferences while the guitar-influenced leather strap enables easy and stylish travel.</p><p> </p><p>The FM radio is perhaps gone for good, the assumption apparently being that the jury has ruled in favor of streaming over the internet. The IR blaster is another feature due for retirement – the S6 had it, then the Note5 didn’t, and now with the S7 the trend is clear.</p><p> </p><p>Perfectly Done</p><p>Meanwhile, the IP68 water resistance has improved from the S5, allowing submersion of up to five feet for 30 minutes, plus there’s no annoying flap covering the charging port</p><p> </p><ul><li>No FM radio (except for T-Mobile units in the US, so far)</li><li>No IR blaster</li><li>No stereo speakers</li></ul><p>If you’ve taken the phone for a plunge in the bath, you’ll need to dry the charging port before plugging in. Samsung hasn’t reinvented the wheel with the design of the Galaxy S7, but it didn’t need to. The Gala S6 was an excellently styled device, and the S7 has managed to improve on that.</p><div><div class="gtx-trans-icon"> </div></div>',
            'image_id'    => $product_image['image-6'],
            'short_desc'  => '<ul><li>Unrestrained and portable active stereo speaker</li><li>Free from the confines of wires and chords</li><li>20 hours of portable capabilities</li><li>Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li><li>3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li></ul>',
            'brand_id'    => $list_brands["adidas"],
            'gallery'     => implode(',',$gallery_image),
            'price'       => '13.43',
            'sale_price'  => null,
            'status'      => 'publish',
            'stock_status'=> 'in',
            'product_type'=> 'simple',
            'create_user' => '1'
        ] );
        $id_7 = DB::table('products')->insertGetId([
            'title'       => "Korea Long Sofa Fabric In Blue Navy Color",
            'slug'        => "korea-long-sofa-fabric-in-blue-navy-color",
            'content'     => '<p><strong>Embodying the Raw, Wayward Spirit of Rock \'N\' Roll</strong></p><p>Embodying the raw, wayward spirit of rock ‘n’ roll, the Kilburn portable active stereo speaker takes the unmistakable look and sound of Marshall, unplugs the chords, and takes the show on the road.</p><p> </p><p>Weighing in under 7 pounds, the Kilburn is a lightweight piece of vintage styled engineering. Setting the bar as one of the loudest speakers in its class, the Kilburn is a compact, stout-hearted hero with a well-balanced audio which boasts a clear midrange and extended highs for a sound that is both articulate and pronounced. The analogue knobs allow you to fine tune the controls to your personal preferences while the guitar-influenced leather strap enables easy and stylish travel.</p><p><img src="/uploads/demo/templates/post-image.jpg" alt="Embodying the Raw, Wayward Spirit of Rock \'N\' Roll" width="654" height="205" /></p><p>What do you get</p><p>Sound of Marshall, unplugs the chords, and takes the show on the road.</p><p>Weighing in under 7 pounds, the Kilburn is a lightweight piece of vintage styled engineering. Setting the bar as one of the loudest speakers in its class, the Kilburn is a compact, stout-hearted hero with a well-balanced audio which boasts a clear midrange and extended highs for a sound that is both articulate and pronounced. The analogue knobs allow you to fine tune the controls to your personal preferences while the guitar-influenced leather strap enables easy and stylish travel.</p><p> </p><p>The FM radio is perhaps gone for good, the assumption apparently being that the jury has ruled in favor of streaming over the internet. The IR blaster is another feature due for retirement – the S6 had it, then the Note5 didn’t, and now with the S7 the trend is clear.</p><p> </p><p>Perfectly Done</p><p>Meanwhile, the IP68 water resistance has improved from the S5, allowing submersion of up to five feet for 30 minutes, plus there’s no annoying flap covering the charging port</p><p> </p><ul><li>No FM radio (except for T-Mobile units in the US, so far)</li><li>No IR blaster</li><li>No stereo speakers</li></ul><p>If you’ve taken the phone for a plunge in the bath, you’ll need to dry the charging port before plugging in. Samsung hasn’t reinvented the wheel with the design of the Galaxy S7, but it didn’t need to. The Gala S6 was an excellently styled device, and the S7 has managed to improve on that.</p><div><div class="gtx-trans-icon"> </div></div>',
            'image_id'    => $product_image['image-7'],
            'short_desc'  => '<ul><li>Unrestrained and portable active stereo speaker</li><li>Free from the confines of wires and chords</li><li>20 hours of portable capabilities</li><li>Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li><li>3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li></ul>',
            'brand_id'    => $list_brands["adidas"],
            'gallery'     => implode(',',$gallery_image),
            'price'       => '679.80',
            'sale_price'  => '567.99',
            'status'      => 'publish',
            'stock_status'=> 'in',
            'product_type'=> 'simple',
            'create_user' => '1'
        ] );

        $list_products[] = [
            'id'=>$id_1,
            "cats"=>"Clothing & Apparel"
        ];
        $list_products[] = [
            'id'=>$id_2,
            "cats"=>"Clothing & Apparel"
        ];
        $list_products[] = [
            'id'=>$id_3,
            "cats"=>"Clothing & Apparel"
        ];
        $list_products[] = [
            'id'=>$id_4,
            "cats"=>"Clothing & Apparel"
        ];
        $list_products[] = [
            'id'=>$id_5,
            "cats"=>"Clothing & Apparel"
        ];
        $list_products[] = [
            'id'=>$id_6,
            "cats"=>"Clothing & Apparel"
        ];
        $list_products[] = [
            'id'=>$id_7,
            "cats"=>"Clothing & Apparel"
        ];

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

        $list_categories = [];

        //attr
        $attr = [];
        $attr['color'] = DB::table('bravo_attrs')->insertGetId([
            'name'      =>      'Color',
            'display_type'=>    'color',
            'slug'      =>      'color',
            'service'   =>      'product',
            'create_user'=>     '1'
        ]);
        $attr['size'] = DB::table('bravo_attrs')->insertGetId([
            'name'      =>      'Size',
            'display_type'=>    'text',
            'slug'      =>      'size',
            'service'   =>      'product',
            'create_user'=>     '1'
        ]);

        $term_list = [
            [
                'name'      =>      'Red',
                'content'   =>      '#FF0000',
                'attr_id'   =>      $attr['color'],
                'slug'      =>      'red'
            ],
            [
                'name'      =>      'Black',
                'content'   =>      '#000000',
                'attr_id'   =>      $attr['color'],
                'slug'      =>      'black'
            ],
            [
                'name'      =>      'Blue',
                'content'   =>      '#0000FF',
                'attr_id'   =>      $attr['color'],
                'slug'      =>      'blue'
            ],
            [
                'name'      =>      'S',
                'content'   =>      'S',
                'attr_id'   =>      $attr['size'],
                'slug'      =>      's'
            ],
            [
                'name'      =>      'M',
                'content'   =>      'M',
                'attr_id'   =>      $attr['size'],
                'slug'      =>      'm'
            ],
            [
                'name'      =>      'L',
                'content'   =>      'L',
                'attr_id'   =>      $attr['size'],
                'slug'      =>      'l'
            ],
            [
                'name'      =>      'XL',
                'content'   =>      'XL',
                'attr_id'   =>      $attr['size'],
                'slug'      =>      'xl'
            ],
            [
                'name'      =>      'XXL',
                'content'   =>      'XXL',
                'attr_id'   =>      $attr['size'],
                'slug'      =>      'Xl'
            ],
        ];
        DB::table('bravo_terms')->insert($term_list);

        foreach ($categories as $category){
            $childs = $category['child'] ?? "";
            if(!empty($childs)){
                unset($category['child']);
            }
            $row = new ProductCategory( $category );
            $row->save();
            $list_categories[$category['name']] = $parent_id = $row->id;
            if(!empty($childs)){
                foreach ($childs as $child){
                    $child['parent_id'] = $parent_id;
                    $child = new ProductCategory( $child );
                    $child->save();
                    $list_categories [$child['name']] = $child->id;
                }
            }
        }
        foreach ($list_products as $product){
            $id = $product['id'];
            $cats = explode(",",$product['cats']);
            foreach ($list_categories as $key => $cat_id) {
                if( in_array( $key , $cats ) ){
                    $rs = new ProductCategoryRelation([
                        'cat_id' => $cat_id,
                        'target_id' => $id
                    ]);
                    $rs->save();
                }
            }

            \Modules\Product\Models\ProductTerm::firstOrCreate([
                'term_id' => rand(1,2),
                'target_id' => $id
            ]);
            \Modules\Product\Models\ProductTerm::firstOrCreate([
                'term_id' => rand(3,7),
                'target_id' => $id
            ]);

        }

        DB::table('bravo_coupon')->insert(
            [
                [
                    'name'  =>  'QF645TY6',
                    'coupon_type'  =>  'percent',
                    'discount'=>50,
                    'expiration'=> date('Y-m-d').' - '.date('Y-m-d',strtotime(date('Y/m/d')."+5 days")),
                    'email'     => '["admin@dev.com","vendor1@dev.com"]',
                    'customer_id'   =>  '["14","16"]',
                    'per_coupon'    =>  2,
                    'per_user'    =>  3,
                    'status'    =>  'publish',
                    'create_user'   =>  1
                ],
                [
                    'name'  =>  '4F29N73F',
                    'coupon_type'  =>  'percent',
                    'discount'=>10,
                    'expiration'=> date('Y-m-d').' - '.date('Y-m-d',strtotime(date('Y/m/d')."+2 days")),
                    'email'     => '["vendor1@dev.com"]',
                    'customer_id'   =>  '["11","12"]',
                    'per_coupon'    =>  2,
                    'per_user'    =>  3,
                    'status'    =>  'publish',
                    'create_user'   =>  1
                ],
                [
                    'name'  =>  '26EF7JTB',
                    'coupon_type'  =>  'percent',
                    'discount'=>20,
                    'expiration'=> date('Y-m-d').' - '.date('Y-m-d',strtotime(date('Y/m/d')."+1 days")),
                    'email'     => '',
                    'customer_id'   =>  '["11"]',
                    'per_coupon'    =>  2,
                    'per_user'    =>  3,
                    'status'    =>  'publish',
                    'create_user'   =>  1
                ],
            ]
        );
    }
}
