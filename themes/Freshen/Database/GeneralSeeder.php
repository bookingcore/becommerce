<?php
namespace Themes\Freshen\Database;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Media\Models\MediaFile;

class GeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        //Setting header,footer
        $menu_department = $this->generalMenuDepartment();
        $id_department = DB::table('core_menus')->insertGetId([
            'name'        => 'Menu Department',
            'items'       => json_encode($menu_department),
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]);

        $logo_light = MediaFile::updateOrCreate(['file_name' => 'freshen-logo-light', 'file_path' => 'freshen/general/logo-light.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'freshen-logo-light']);
        $logo_dark = MediaFile::updateOrCreate(['file_name' => 'freshen-logo-dark', 'file_path' => 'freshen/general/logo-dark.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'freshen-logo-dark']);
        $bg_footer_1 = MediaFile::updateOrCreate(['file_name' => 'freshen-bg-footer-1', 'file_path' => 'freshen/general/bg-footer-1.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'freshen-bg-footer-1']);
        setting_update_items(
            [
                [
                    'name'  => 'freshen_logo_light',
                    'val'   => $logo_light->id,
                ],
                [
                    'name'  => 'freshen_logo_dark',
                    'val'   => $logo_dark->id,
                ],
                [
                    'name'  => 'freshen_hotline_contact',
                    'val'   => '(+035) 527-1710-70',
                ],
                [
                    'name'  => 'freshen_email_contact',
                    'val'   => 'order@freshen.com',
                ],
                [
                    'name'  => 'freshen_footer_style',
                    'val'   => 'style_1',
                ],
                [
                    'name'  => 'freshen_header_style',
                    'val'   => '1',
                ],
                [
                    'name'  => 'freshen_footer_bg_image',
                    'val'   => $bg_footer_1->id,
                ],
                [
                    'name'  => 'freshen_list_widget_footer',
                    'val'   => '[{"title":"NEED HELP","size":"3","content":"<ul class=\"list-unstyled\">\r\n  <li class=\"text-white\"><a class=\"phone\" href=\"#\">Phone: 00 0392 96 32<\/a><\/li>\r\n  <li class=\"text-white\"><a href=\"#\">Monday - Friday : 9:00 - 20:00<\/a><\/li>\r\n  <li class=\"text-white\"><a href=\"#\">Saturday: 11:00 - 14:00<\/a><\/li>\r\n  <li class=\"text-white\"><a href=\"#\">Email: oder@freshen.com<\/a><\/li>\r\n<\/ul>"},{"title":"INFORMATION","size":"2","content":"<ul class=\"list-unstyled\">\r\n  <li><a href=\"#\">Delivery Information<\/a><\/li>\r\n  <li><a href=\"#\">Privacy Policy<\/a><\/li>\r\n  <li><a href=\"#\">Terms &amp; Conditions<\/a><\/li>\r\n  <li><a href=\"#\">Contact<\/a><\/li>\r\n  <li><a href=\"#\">Returns<\/a><\/li>\r\n  <li><a href=\"#\">Affilate<\/a><\/li>\r\n<\/ul>"},{"title":"ACCOUNT","size":"2","content":"<ul class=\"list-unstyled\">\r\n  <li><a href=\"#\">My account<\/a><\/li>\r\n  <li><a href=\"#\">Order History<\/a><\/li>\r\n  <li><a href=\"#\">Wishlist<\/a><\/li>\r\n  <li><a href=\"#\">Shipping<\/a><\/li>\r\n  <li><a href=\"#\">Privacy Policy<\/a><\/li>\r\n  <li><a href=\"#\">Help<\/a><\/li>\r\n<\/ul>"},{"title":"OUR STORES","size":"2","content":"<ul class=\"list-unstyled\">\r\n  <li><a href=\"#\">New York<\/a><\/li>\r\n  <li><a href=\"#\">London SF<\/a><\/li>\r\n  <li><a href=\"#\">Cockfosters BP<\/a><\/li>\r\n  <li><a href=\"#\">Los Angeles<\/a><\/li>\r\n  <li><a href=\"#\">Chicago<\/a><\/li>\r\n  <li><a href=\"#\">Las Vegas<\/a><\/li>\r\n<\/ul>"}]',
                ],
                [
                    'name'  => 'freshen_footer_info_text',
                    'val'   => '<div class="footer_about_widget">
    <p>Collins Street West, Victoria <br> 8007, Australia.</p>
    <a href="#" class="shop_map_btn">SHOW ON MAP</a>
</div>
<div class="footer_social_widget mt30">
    <ul class="mb0">
      <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
      <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
      <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
      <li class="list-inline-item"><a href="#"><i class="fa fa-youtube-play"></i></a></li>
      <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
    </ul>
</div>',
                ],
                [
                    'name'  => 'freshen_footer_text_right',
                    'val'   => '<p><img src="/uploads/freshen/general/payment-getway.png" /></p>',
                ],
                [
                    'name'  => 'freshen_copyright',
                    'val'   => '© 2022 Freshen. Made with love.',
                ],
            ]
        );
        $freshen_home_2 = [
            'img_1'=> DB::table('media_files')->insertGetId( ['file_name' => '5', 'file_path' => 'themes/Freshen/images/banner/5.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'img_2'=> DB::table('media_files')->insertGetId( ['file_name' => '6', 'file_path' => 'themes/Freshen/images/banner/6.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'img_3'=> DB::table('media_files')->insertGetId( ['file_name' => '7', 'file_path' => 'themes/Freshen/images/banner/7.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'img_4'=> DB::table('media_files')->insertGetId( ['file_name' => '1', 'file_path' => 'themes/Freshen/images/why-chose/1.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'img_5'=> DB::table('media_files')->insertGetId( ['file_name' => '2', 'file_path' => 'themes/Freshen/images/why-chose/2.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'img_6'=> DB::table('media_files')->insertGetId( ['file_name' => '3', 'file_path' => 'themes/Freshen/images/why-chose/3.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'img_7'=> DB::table('media_files')->insertGetId( ['file_name' => 'fruit1', 'file_path' => 'themes/Freshen/images/banner/fruit1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'img_8'=> DB::table('media_files')->insertGetId( ['file_name' => 'veg1', 'file_path' => 'themes/Freshen/images/banner/veg1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'img_9'=> DB::table('media_files')->insertGetId( ['file_name' => 'fg1', 'file_path' => 'themes/Freshen/images/banner/fg1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
        ];
        // Freshen home page 2 template
        DB::table('core_templates')->insert(
            [
                'title' =>  'Freshen Home Page 2',
                'content'   =>  '[{"type":"banner_slider_v2","name":"Banner Slider V2","model":{"style":"style_1","sliders":[{"_active":true,"title":"<span class=\"fwb\">Get fresher food</span><br><span class=\"text-thm fw400\">every days</span>","sub_title":"All natural products ","image":'. $freshen_home_2['img_1'] .',"sub_text":"<span class=\"fwb\">Organic food</span> is food produced by methods that comply with the <br> standards of organic farming.","btn_shop_now":"SHOP NOW","link_shop_now":"#"},{"_active":true,"title":"<span class=\"fwb\">Healthy Food</span><br><span class=\"text-thm fw400\">&amp; Organic Market</span>","sub_title":"<span class=\"fwb\">Organic food</span> is food produced by methods that comply with the <br> standards of organic farming.","image":'. $freshen_home_2['img_1'] .',"sub_text":"All natural products ","btn_shop_now":"SHOP NOW","link_shop_now":"#"}],"sliders_2":[{"_active":true,"title":"Up To Breads ","sub_title":"SEASONAL SALE","image":'. $freshen_home_2['img_2'] .',"sub_text":"50% OFF","btn_shop_now":"SHOP NOW","link_shop_now":"#"},{"_active":true,"title":"Fresh Vegetables","sub_title":"Tasty Healthy","image":'. $freshen_home_2['img_3'] .',"sub_text":"","btn_shop_now":"SHOP NOW","link_shop_now":"#"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"why_chose_us","name":"Why Chose Us","model":{"title":"","list_items":[{"_active":true,"title":"WE DRIVE FAST & SHIP FASTER","desc":"Sed semper convallis ultricies. Aliqua erat vol esent friday ngilla augue","image_id":'. $freshen_home_2['img_4'] .'},{"_active":true,"title":"WE SAVE YOUR MORE MONEY","desc":"Sed semper convallis ultricies. Aliqua erat vol esent friday ngilla augue.","image_id":'. $freshen_home_2['img_5'] .'},{"_active":true,"title":"DAILY DISCOUNT COUPONS","desc":"Sed semper convallis ultricies. Aliqua erat vol esent friday ngilla augue.","image_id":'. $freshen_home_2['img_6'] .'}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"product_in_category","name":"Product: In Category","model":{"style":"style_1","title":"FRUITS","category_id":"37","number":6,"order":"id","order_by":"desc","load_more_url":"#","load_more_name":"VIEW ALL","bg_image":'. $freshen_home_2['img_7'] .',"bg_title":"FRESH SUMMER WITH JUST $200.99","bg_sub_title":"FRESH FRUIT","link_apply":"SHOP NOW","url_apply":"#"},"component":"RegularBlock","open":true,"is_container":false},{"type":"product_in_category","name":"Product: In Category","model":{"style":"","title":"VEGETABLES","category_id":"","number":6,"order":"id","order_by":"desc","load_more_url":"#","load_more_name":"VIEW ALL","bg_image":'. $freshen_home_2['img_8'] .',"bg_title":"FRESH VEGETABLES","bg_sub_title":"TASTY HEALTHY","link_apply":"SHOP NOW","url_apply":"#"},"component":"RegularBlock","open":true,"is_container":false},{"type":"product_in_category","name":"Product: In Category","model":{"style":"style_1","title":"FOOD & GROCERY","category_id":"37","number":6,"order":"id","order_by":"desc","load_more_url":"#","load_more_name":"VIEW ALL","bg_image":'. $freshen_home_2['img_9'] .',"bg_title":"SEASON DISCOUNT","bg_sub_title":"20% OFF","link_apply":"SHOP NOW","url_apply":"#"},"component":"RegularBlock","open":true}]',
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );
        // Freshen home page 2
        DB::table('core_pages')->insert([
            'title'       => 'Freshen Home Page 2',
            'slug'        => 'freshen-home-page-2',
            'template_id' => '4',
            'show_template' => 1,
            'author_id' => 1,
            'create_user' => '1',
            'status'      => 'publish',
            'created_at'  => date("Y-m-d H:i:s")
        ]);

        // Freshen home page 3 template
        DB::table('core_templates')->insert(
            [
                'title' =>  'Freshen Home Page 3',
                'content'   =>  '[{"type":"banner_slider","name":"Banner Slider","model":{"width_slider":"slider-fluid","sliders":[{"_active":true,"title":"<span class=\"fwb\">Up To Breads</span><br><span class=\"text-thm3\">50% Off</span>","sub_title":"All natural products","image":30,"sub_text":"<span class=\"fwb\">Organic food</span> is food produced by methods that comply with the <br> standards of organic farming.","btn_shop_now":"Shop Now","link_shop_now":"#"},{"_active":true,"title":"<span class=\"fwb\">Healthy Food</span><br><span class=\"text-thm3\">every days</span>","sub_title":"All natural products","image":32,"sub_text":"<span class=\"fwb\">Organic food</span> is food produced by methods that comply with the <br> standards of organic farming.","btn_shop_now":"Shop Now","link_shop_now":"#"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"featured_icon","name":"Featured Icon","model":{"list_items":[{"_active":true,"title":"Free Delivery","sub_title":"For all oders over $99","icon":"flaticon-fast text-thm3"},{"_active":true,"title":"Secure Payment","sub_title":"100% secure payment","icon":"flaticon-customer-1 text-thm3"},{"_active":true,"title":"90 Days Return","sub_title":"If goods have problems","icon":"flaticon-returning text-thm3"},{"_active":true,"title":"24/7 Support","sub_title":"Dedicated support","icon":"flaticon-support text-thm3"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"promotion","name":"Promotion","model":{"title":"","list_items":[{"_active":false,"sub_title":"FRESH FRUIT","title":"FRESH SUMMER WITH JUST $200.99","link":"#","image":33},{"_active":true,"sub_title":"TASTY HEALTHY","title":"FRESH VEGETABLES","link":"#","image":34}],"style":"style_2"},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_category_product","name":"Product: List Tab Category","model":{"title":"FEATURED PRODUCTS","cat_ids":["9","8","7","6"],"number":10,"order":"id","order_by":"desc"},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_category","name":"List Category","model":{"title":"CATEGORIES","list_items":[{"_active":true,"category_id":"8","image_id":35,"title":"Food & Grocery"},{"_active":true,"category_id":"2","image_id":35,"title":"Vegetables"},{"_active":true,"category_id":"1","image_id":35,"title":"Fruits"},{"_active":true,"category_id":"3","image_id":35,"title":"Sea Food"},{"_active":true,"category_id":"5","image_id":35,"title":"Bakery"},{"_active":true,"category_id":"6","image_id":35,"title":"Fresh Meat"}],"style":"style_2","list_items_2":[{"_active":true,"title":"Food & Grocery","image_id":35,"category_ids":["6","7","8","9"],"btn_name":"VIEW ALL","btn_url":"#"},{"_active":true,"title":"Vegetables","image_id":35,"category_ids":["5","6","8","9"],"btn_name":"VIEW ALL","btn_url":"#"},{"_active":true,"title":"Fruits","image_id":35,"category_ids":["1","3","4","5"],"btn_name":"VIEW ALL","btn_url":"#"},{"_active":true,"title":"Sea Food","image_id":24,"category_ids":["6","8"],"btn_name":"VIEW ALL","btn_url":"#"},{"_active":true,"title":"Bakery","image_id":35,"category_ids":["4","5","6","8"],"btn_name":"VIEW ALL","btn_url":"#"},{"_active":true,"title":"Fresh Meat","image_id":23,"category_ids":["5","7"],"btn_name":"VIEW ALL","btn_url":"#"}],"btn_name":"VIEW ALL","btn_url":"#"},"component":"RegularBlock","open":true,"is_container":false},{"type":"whats_app","name":"Whats App","model":{"style":"style_1","title":"Whatsapp Ordering Service","icon":"flaticon-whatsapp","title2":"Place Your Orders At +1 246-345-0695"},"component":"RegularBlock","open":true}]',
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );
        // Freshen home page 3
        DB::table('core_pages')->insert([
            'title'       => 'Freshen Home Page 3',
            'slug'        => 'freshen-home-page-3',
            'template_id' => '5',
            'show_template' => 1,
            'author_id' => 1,
            'create_user' => '1',
            'status'      => 'publish',
            'created_at'  => date("Y-m-d H:i:s")
        ]);
    }

    public function generalMenuDepartment($locale = ''){
        return  array(
            array(
                'name'       => 'Hot Offers',
                'url'        => '/',
                'item_model' => 'custom',
                'model_name' => 'Custom',
                'layout'     => '',
                'icon'       => 'flaticon-hot-sale',
                'bg'         => '',
                'children'   => array(),
            ),
            array(
                'name'       => 'New Arrivals',
                'url'        => '/',
                'item_model' => 'custom',
                'model_name' => 'Custom',
                'layout'     => '',
                'icon'       => 'flaticon-bell',
                'bg'         => '',
                'children'   => array(),
            ),
            array(
                'name'       => 'Deals of The Day',
                'url'        => '/',
                'item_model' => 'custom',
                'model_name' => 'Custom',
                'layout'     => '',
                'icon'       => 'flaticon-discount',
                'bg'         => '',
                'children'   => array(),
            ),



            array(
                'name'       => 'Fruits',
                'url'        => '/',
                'item_model' => 'custom',
                'model_name' => 'Custom',
                'layout'     => 'multi_row',
                'icon'       => 'flaticon-harvest',
                'bg'         => '',
                'children'   => array(
                    array(
                        'name'       => 'Fruits',
                        'url'        => '/',
                        'item_model' => 'custom',
                        'children'   => array(
                            array(
                                'name'       => 'Apples & Bananas',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Berries',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Grapes',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Mangoes',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Melons',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Pears',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                        ),
                    ),
                    array(
                        'name'       => 'Apricots',
                        'url'        => '/',
                        'item_model' => 'custom',
                        'children'   => array(
                            array(
                                'name'       => 'Mixed Dried Fruits',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                           array(
                                'name'       => 'Prunes',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                           array(
                                'name'       => 'Raisins',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                        ),
                    ),
                ),
            ),

            array(
                'name'       => 'Vegetables',
                'url'        => '/',
                'item_model' => 'custom',
                'model_name' => 'Custom',
                'layout'     => 'multi_row',
                'icon'       => 'flaticon-vegetable',
                'bg'         => '',
                'children'   => array(
                    array(
                        'name'       => 'Vegetables',
                        'url'        => '/',
                        'item_model' => 'custom',
                        'children'   => array(
                            array(
                                'name'       => 'Apples & Bananas',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Berries',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Grapes',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Mangoes',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Melons',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Pears',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                        ),
                    ),
                    array(
                        'name'       => 'Apricots',
                        'url'        => '/',
                        'item_model' => 'custom',
                        'children'   => array(
                            array(
                                'name'       => 'Mixed Dried Fruits',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Prunes',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Raisins',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                        ),
                    ),
                ),
            ),

            array(
                'name'       => 'Drinks',
                'url'        => '/',
                'item_model' => 'custom',
                'model_name' => 'Custom',
                'layout'     => '',
                'icon'       => 'flaticon-plastic-bottle',
                'bg'         => '',
                'children'   => array(),
            ),
            array(
                'name'       => 'Bakery',
                'url'        => '/',
                'item_model' => 'custom',
                'model_name' => 'Custom',
                'layout'     => 'multi_row',
                'icon'       => 'flaticon-bread-1',
                'bg'         => '',
                'children'   => array(
                    array(
                        'name'       => 'Vegetables',
                        'url'        => '/',
                        'item_model' => 'custom',
                        'children'   => array(
                            array(
                                'name'       => 'Apples & Bananas',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Berries',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Grapes',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Mangoes',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Melons',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Pears',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                        ),
                    ),
                    array(
                        'name'       => 'Apricots',
                        'url'        => '/',
                        'item_model' => 'custom',
                        'children'   => array(
                            array(
                                'name'       => 'Mixed Dried Fruits',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Prunes',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Raisins',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                        ),
                    ),
                ),
            ),

            array(
                'name'       => 'Butter & Egges',
                'url'        => '/',
                'item_model' => 'custom',
                'model_name' => 'Custom',
                'layout'     => '',
                'icon'       => 'flaticon-boiled-egg',
                'bg'         => '',
                'children'   => array(),
            ),

            array(
                'name'       => 'Milks & Creams',
                'url'        => '/',
                'item_model' => 'custom',
                'model_name' => 'Custom',
                'layout'     => 'multi_row',
                'icon'       => 'flaticon-milk-1',
                'bg'         => '',
                'children'   => array(
                    array(
                        'name'       => 'Vegetables',
                        'url'        => '/',
                        'item_model' => 'custom',
                        'children'   => array(
                            array(
                                'name'       => 'Apples & Bananas',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Berries',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Grapes',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Mangoes',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Melons',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Pears',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                        ),
                    ),
                    array(
                        'name'       => 'Apricots',
                        'url'        => '/',
                        'item_model' => 'custom',
                        'children'   => array(
                            array(
                                'name'       => 'Mixed Dried Fruits',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Prunes',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                            array(
                                'name'       => 'Raisins',
                                'url'        => '/',
                                'item_model' => 'custom',
                                'children'   => array(),
                            ),
                        ),
                    ),
                ),
            ),

            array(
                'name'       => 'Meats',
                'url'        => '/',
                'item_model' => 'custom',
                'model_name' => 'Custom',
                'layout'     => '',
                'icon'       => 'flaticon-meat',
                'bg'         => '',
                'children'   => array(),
            ),

            array(
                'name'       => 'Fish',
                'url'        => '/',
                'item_model' => 'custom',
                'model_name' => 'Custom',
                'layout'     => '',
                'icon'       => 'flaticon-fish',
                'bg'         => '',
                'children'   => array(),
            ),
        );
    }
}
