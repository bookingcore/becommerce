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
        $primary_menu = [
            [
                "id"            => 1,
                "name"          => "Home Page",
                "url"           => "/",
                "class"         => "",
                "target"        => "",
                "item_model" => "custom",
                "_open"         => false,
                "origin_edit_url"=> "",
                "children"  =>  [
                    [
                        "name" => "Home Page 1",
                        "url" => "/page/freshen-home-page-1",
                        "item_model" => "custom",
                        "_open" => false,
                        "model_name" => "Custom",
                        "is_removed" => true
                    ],
                    [
                        "name" => "Home Page 2",
                        "url" => "/page/freshen-home-page-2",
                        "item_model" => "custom",
                        "_open" => false,
                        "model_name" => "Custom",
                        "is_removed" => true
                    ],
                    [
                        "name" => "Home Page 3",
                        "url" => "/page/freshen-home-page-3",
                        "item_model" => "custom",
                        "_open" => false,
                        "model_name" => "Custom",
                        "is_removed" => true
                    ],
                    [
                        "name" => "Home Page 4",
                        "url" => "/page/freshen-home-page-4",
                        "item_model" => "custom",
                        "_open" => false,
                        "model_name" => "Custom",
                        "is_removed" => true
                    ],
                ]
            ],
            [
                "name" =>"Shop",
                "url"  =>"",
                "item_model" => "custom",
                "_open" => false,
                "model_name"=> "Custom",
                "is_removed"=> true,
                "children"  =>  [
                    [
                        "name" => "Shop",
                        "url" => "/product",
                        "item_model" => "custom",
                        "_open" => false,
                        "model_name" => "Custom",
                        "is_removed" => true
                    ],
                    [
                        "name" => "Category Layout",
                        "url" => "/category/vegetables",
                        "item_model" => "custom",
                        "_open" => false,
                        "model_name" => "Custom",
                        "is_removed" => true
                    ],

                    [
                        "name" => "Simple Product",
                        "url" => "/product/pineapple-tropical-gold",
                        "item_model" => "custom",
                        "_open" => false,
                        "model_name" => "Custom",
                        "is_removed" => true
                    ],
                    [
                        "name" => "Variable Product",
                        "url" => "/product/silver-heinz-ketchup",
                        "item_model" => "custom",
                        "_open" => false,
                        "model_name" => "Custom",
                        "is_removed" => true
                    ],
                    [
                        "name" => "Affiliate Product",
                        "url" => "/product/augason-farms-freeze-dried-beef-chunks",
                        "item_model" => "custom",
                        "_open" => false,
                        "model_name" => "Custom",
                        "is_removed" => true
                    ],
                ]
            ],
            [
                "name" => "Pages",
                "url" => "",
                "item_model" => "custom",
                "_open" => false,
                "model_name" => "Custom",
                "is_removed" => true,
                "children" => [
                    [
                        "name" => "About us",
                        "url" => "/page/freshen-about-us",
                        "item_model" => "custom",
                        "_open" => false,
                        "target" => "",
                    ],
                    [
                        "name" => "Shopping Cart",
                        "url" => "/cart",
                        "item_model" => "custom",
                        "_open" => false,
                        "model_name" => "Custom",
                        "is_removed" => true
                    ],
                    [
                        "name" => "Wishlist",
                        "url" => "/user/wishlist",
                        "item_model" => "custom",
                        "_open" => false,
                        "model_name" => "Custom",
                        "is_removed" => true
                    ],
                    [
                        "name" => "My account",
                        "url" => "/user/profile",
                        "item_model" => "custom",
                        "_open" => false
                    ]
                ]
            ],
            [
                "name" => "News",
                "url" => "",
                "item_model" => "custom",
                "_open" => false,
                "target" => "",
                "children" => [
                    [
                        "name" => "News List",
                        "url" => "/news",
                        "item_model" => "custom",
                        "_open" => false
                    ],
                    [
                        "name" => "News Detail",
                        "url" => "/news/explore-fashion-trending-for-guys-in-autumn-2017",
                        "item_model" => "custom",
                        "_open" => false
                    ],
                ]
            ],
            [
                "name" => "Contact",
                "url" => "/page/freshen-contact",
                "item_model" => "custom",
                "_open" => false,
                "target" => "",
            ]
        ];
        //Menu
        $menu_id = DB::table('core_menus')->insertGetId(
            [
                'name'  => "Freshen Menu",
                'items' =>  json_encode($primary_menu,true),
                'create_user'   =>  1,
                'update_user'   =>  1
            ]
        );

        $menu_department = $this->generalMenuDepartment();
        $department_id = DB::table('core_menus')->insertGetId([
            'name'        => 'Menu Department',
            'items'       => json_encode($menu_department),
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]);

        setting_update_item('menu_locations','{"primary":'.$menu_id.',"department":'.$department_id.'}');

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

        $freshen_home_1 = [
            'freshen-banner-slider-1'=> MediaFile::updateOrCreate(['file_name' => 'freshen-banner-slider-1', 'file_path' => 'freshen/general/banner-slider-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'freshen-banner-slider-1'])->id,
            'freshen-promotion-1'=> MediaFile::updateOrCreate(['file_name' => 'freshen-promotion-1', 'file_path' => 'freshen/general/promotion-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'freshen-promotion-1'])->id,
            'freshen-promotion-2'=> MediaFile::updateOrCreate(['file_name' => 'freshen-promotion-2', 'file_path' => 'freshen/general/promotion-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'freshen-promotion-2'])->id,
            'freshen-promotion-3'=> MediaFile::updateOrCreate(['file_name' => 'freshen-promotion-3', 'file_path' => 'freshen/general/promotion-3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'freshen-promotion-3'])->id,
            'freshen-delivery'=> MediaFile::updateOrCreate(['file_name' => 'freshen-delivery', 'file_path' => 'freshen/general/delivery.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'freshen-delivery'])->id,
            'freshen-partner-bg-1'=> MediaFile::updateOrCreate(['file_name' => 'freshen-partner-bg-1', 'file_path' => 'freshen/general/partner-bg-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'freshen-partner-bg-1'])->id,
            'freshen-logo-partner-1'=> MediaFile::updateOrCreate(['file_name' => 'freshen-logo-partner-1', 'file_path' => 'freshen/general/logo-partner-1.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'freshen-logo-partner-1'])->id,
            'freshen-logo-partner-2'=> MediaFile::updateOrCreate(['file_name' => 'freshen-logo-partner-2', 'file_path' => 'freshen/general/logo-partner-2.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'freshen-logo-partner-2'])->id,
            'freshen-logo-partner-3'=> MediaFile::updateOrCreate(['file_name' => 'freshen-logo-partner-3', 'file_path' => 'freshen/general/logo-partner-3.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'freshen-logo-partner-3'])->id,
            'freshen-logo-partner-4'=> MediaFile::updateOrCreate(['file_name' => 'freshen-logo-partner-4', 'file_path' => 'freshen/general/logo-partner-4.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'freshen-logo-partner-4'])->id,
            'freshen-logo-partner-5'=> MediaFile::updateOrCreate(['file_name' => 'freshen-logo-partner-5', 'file_path' => 'freshen/general/logo-partner-5.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'freshen-logo-partner-5'])->id,
            'freshen-why-chose-1'=> MediaFile::updateOrCreate(['file_name' => 'freshen-why-chose-1', 'file_path' => 'freshen/general/why-chose-1.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'freshen-why-chose-1'])->id,
            'freshen-why-chose-2'=> MediaFile::updateOrCreate(['file_name' => 'freshen-why-chose-2', 'file_path' => 'freshen/general/why-chose-2.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'freshen-why-chose-2'])->id,
            'freshen-why-chose-3'=> MediaFile::updateOrCreate(['file_name' => 'freshen-why-chose-3', 'file_path' => 'freshen/general/why-chose-3.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'freshen-why-chose-3'])->id,
            'freshen-insta-1'=> MediaFile::updateOrCreate(['file_name' => 'freshen-insta-1', 'file_path' => 'freshen/general/insta-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'freshen-insta-1'])->id,
            'freshen-insta-2'=> MediaFile::updateOrCreate(['file_name' => 'freshen-insta-2', 'file_path' => 'freshen/general/insta-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'freshen-insta-2'])->id,
            'freshen-insta-3'=> MediaFile::updateOrCreate(['file_name' => 'freshen-insta-3', 'file_path' => 'freshen/general/insta-3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'freshen-insta-3'])->id,
            'freshen-insta-4'=> MediaFile::updateOrCreate(['file_name' => 'freshen-insta-4', 'file_path' => 'freshen/general/insta-4.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'freshen-insta-4'])->id,
            'freshen-insta-5'=> MediaFile::updateOrCreate(['file_name' => 'freshen-insta-5', 'file_path' => 'freshen/general/insta-5.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'freshen-insta-5'])->id,
            'freshen-cat-1'=> MediaFile::updateOrCreate(['file_name' => 'freshen-cat-1', 'file_path' => 'freshen/product/cat-1.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'freshen-cat-1'])->id,
            'freshen-cat-2'=> MediaFile::updateOrCreate(['file_name' => 'freshen-cat-2', 'file_path' => 'freshen/product/cat-2.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'freshen-cat-2'])->id,
            'freshen-cat-3'=> MediaFile::updateOrCreate(['file_name' => 'freshen-cat-3', 'file_path' => 'freshen/product/cat-3.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'freshen-cat-3'])->id,
            'freshen-cat-4'=> MediaFile::updateOrCreate(['file_name' => 'freshen-cat-4', 'file_path' => 'freshen/product/cat-4.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'freshen-cat-4'])->id,
            'freshen-cat-5'=> MediaFile::updateOrCreate(['file_name' => 'freshen-cat-5', 'file_path' => 'freshen/product/cat-5.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'freshen-cat-5'])->id,
            'freshen-cat-6'=> MediaFile::updateOrCreate(['file_name' => 'freshen-cat-6', 'file_path' => 'freshen/product/cat-6.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'freshen-cat-6'])->id,
            'freshen-cat-7'=> MediaFile::updateOrCreate(['file_name' => 'freshen-cat-7', 'file_path' => 'freshen/product/cat-7.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'freshen-cat-7'])->id,
            'freshen-cat-8'=> MediaFile::updateOrCreate(['file_name' => 'freshen-cat-8', 'file_path' => 'freshen/product/cat-8.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'freshen-cat-8'])->id,
        ];
        $templlate_id = DB::table('core_templates')->insertGetId(
            [
                'title' =>  'Freshen Home Page 1',
                'content'   =>  '[{"type":"banner_slider","name":"Banner Slider","model":{"sliders":[{"_active":false,"title":"<span class=\"text-thm2 fwb\">Healthy Food</span> <br><span class=\"text-thm fw400\">&amp; Organic Market</span>","sub_title":"ALL NATURAL PRODUCTS.","image":'.$freshen_home_1['freshen-banner-slider-1'].',"sub_text":"<strong>Organic food</strong> is food produced by methods that comply with the standards of organic farming.","btn_shop_now":"Shop Now","link_shop_now":"#"},{"_active":false,"title":"<span class=\"text-thm2 fwb\">Double Combo</span> <span class=\"text-thm fw400\">With The Body Shop</span>","sub_title":"Mega Sale Nov 2022","image":'.$freshen_home_1['freshen-banner-slider-1'].',"sub_text":"Discount <strong>70% Off </strong>","btn_shop_now":"Shop now","link_shop_now":"#"}],"width_slider":"container"},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_category","name":"List Category","model":{"title":"TOP CATEGORIES OF THE MONTH","list_items":[{"_active":true,"category_id":"1","image_id":'.$freshen_home_1['freshen-cat-1'].'},{"_active":true,"category_id":"2","image_id":'.$freshen_home_1['freshen-cat-2'].'},{"_active":true,"category_id":"3","image_id":'.$freshen_home_1['freshen-cat-3'].'},{"_active":true,"category_id":"4","image_id":'.$freshen_home_1['freshen-cat-4'].'},{"_active":true,"category_id":"5","image_id":'.$freshen_home_1['freshen-cat-5'].'},{"_active":true,"category_id":"6","image_id":'.$freshen_home_1['freshen-cat-6'].'},{"_active":true,"category_id":"7","image_id":'.$freshen_home_1['freshen-cat-7'].'},{"_active":true,"category_id":"8","image_id":'.$freshen_home_1['freshen-cat-8'].'}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"promotion","name":"Promotion","model":{"col":"3","list_items":[{"_active":true,"image":'.$freshen_home_1['freshen-promotion-1'].',"title":"FRESH SUMMER WITH JUST $200.99","link":"#","sub_title":"FRESH FRUIT"},{"_active":true,"image":'.$freshen_home_1['freshen-promotion-2'].',"title":"UP TO BREADS <span class=\"text-thm2\">50% Off</span>","link":"#","sub_title":"SEASONAL SALE"},{"_active":true,"image":'.$freshen_home_1['freshen-promotion-3'].',"link":"#","title":"FRESH <span class=\"text-thm2\">Vegetables</span>","sub_title":"TASTY HEALTHY"}],"title":"Promotion","sub_title":"Recommended for you"},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_category_product","name":"Product: List Tab Category","model":{"title":"FEATURED PRODUCTS","cat_ids":["8","6","4","7"],"number":8,"order":"id","order_by":"desc"},"component":"RegularBlock","open":true,"is_container":false},{"type":"deliver","name":"Deliver Divider","model":{"title":"WHATSAPP ORDERING SERVICE – PLACE YOUR ORDERS AT ","phone":"392 96 32","image_id":'.$freshen_home_1['freshen-delivery'].'},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_product","name":"Product: List item","model":{"style_list":"","title":"Newsest Products","sub_title":"Recommended for you","cat_ids":"","number":8,"order":"id","order_by":"desc","is_featured":""},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_partner","name":"List Partner","model":{"sub_title":"ORANGE JUICE","title":"FOR HUMAN HEALTH","desc":"Organic food is food produced by methods that comply with the standards of organic farming. Standards vary worldwide, but organic farming in general features.","link_shop":"#","bg_image":'.$freshen_home_1['freshen-partner-bg-1'].',"list_items":[{"_active":true,"image_id":'.$freshen_home_1['freshen-logo-partner-1'].'},{"_active":true,"image_id":'.$freshen_home_1['freshen-logo-partner-2'].'},{"_active":true,"image_id":'.$freshen_home_1['freshen-logo-partner-3'].'},{"_active":true,"image_id":'.$freshen_home_1['freshen-logo-partner-4'].'},{"_active":true,"image_id":'.$freshen_home_1['freshen-logo-partner-5'].'}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_news","name":"News: List Items","model":{"title":"OUR BLOG","number":3,"category_id":"","order":"id","order_by":"desc"},"component":"RegularBlock","open":true,"is_container":false},{"type":"why_chose_us","name":"Why Chose Us","model":{"title":"WHY CHOOSE US","list_items":[{"_active":true,"title":"WE DRIVE FAST & SHIP FASTER","desc":"Sed semper convallis ultricies. Aliqua erat vol esent friday ngilla augue.","image_id":'.$freshen_home_1['freshen-why-chose-1'].'},{"_active":true,"title":"WE SAVE YOUR MORE MONEY","desc":"Sed semper convallis ultricies. Aliqua erat vol esent friday ngilla augue.","image_id":'.$freshen_home_1['freshen-why-chose-2'].'},{"_active":true,"title":"DAILY DISCOUNT COUPONS","desc":"Sed semper convallis ultricies. Aliqua erat vol esent friday ngilla augue.","image_id":'.$freshen_home_1['freshen-why-chose-3'].'}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"instagram","name":"Instagram","model":{"title":"FOLLOW @FRESHEN ON INSTAGRAM","list_items":[{"_active":true,"image_id":'.$freshen_home_1['freshen-insta-1'].'},{"_active":false,"image_id":'.$freshen_home_1['freshen-insta-2'].'},{"_active":false,"image_id":'.$freshen_home_1['freshen-insta-3'].'},{"_active":false,"image_id":'.$freshen_home_1['freshen-insta-4'].'},{"_active":false,"image_id":'.$freshen_home_1['freshen-insta-5'].'}]},"component":"RegularBlock","open":true,"is_container":false}]',
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );
        $homepage_id = DB::table('core_pages')->insertGetId([
            'title'       => 'Freshen Home Page 1',
            'slug'        => 'freshen-home-page-1',
            'template_id' => $templlate_id,
            'show_template' => 1,
            'author_id' => 1,
            'create_user' => '1',
            'status'      => 'publish',
            'created_at'  => date("Y-m-d H:i:s")
        ]);
        setting_update_item('home_page_id',$homepage_id);

        //Freshen home layout 2
        $freshen_home_2 = [
            'freshen-banner-slider-1'=> MediaFile::updateOrCreate(['file_name' => 'banner-slider-2', 'file_path' => 'freshen/general/banner-slider-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'banner-slider-2'])->id,
            'freshen-banner-slider-2'=> MediaFile::updateOrCreate(['file_name' => 'banner-slider-3', 'file_path' => 'freshen/general/banner-slider-3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'banner-slider-3'])->id,
            'freshen-banner-slider-3'=> MediaFile::updateOrCreate(['file_name' => 'banner-slider-4', 'file_path' => 'freshen/general/banner-slider-4.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'banner-slider-4'])->id,
            'freshen-why-chose-1'=> MediaFile::updateOrCreate(['file_name' => 'freshen-why-chose-1', 'file_path' => 'freshen/general/why-chose-1.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'freshen-why-chose-1'])->id,
            'freshen-why-chose-2'=> MediaFile::updateOrCreate(['file_name' => 'freshen-why-chose-2', 'file_path' => 'freshen/general/why-chose-2.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'freshen-why-chose-2'])->id,
            'freshen-why-chose-3'=> MediaFile::updateOrCreate(['file_name' => 'freshen-why-chose-3', 'file_path' => 'freshen/general/why-chose-3.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'freshen-why-chose-3'])->id,
            'banner-1'=> MediaFile::updateOrCreate(['file_name' => 'banner-1', 'file_path' => 'freshen/general/banner-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'banner-1'])->id,
            'banner-2'=> MediaFile::updateOrCreate(['file_name' => 'banner-2', 'file_path' => 'freshen/general/banner-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'banner-2'])->id,
            'banner-3'=> MediaFile::updateOrCreate(['file_name' => 'banner-3', 'file_path' => 'freshen/general/banner-3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'banner-3'])->id,
        ];
        // Freshen home page 2 template
        $freshen_templlate2_id = DB::table('core_templates')->insertGetId(
            [
                'title' =>  'Freshen Home Page 2',
                'content'   =>  '[{"type":"banner_slider_v2","name":"Banner Slider V2","model":{"style":"style_1","sliders":[{"_active":true,"title":"<span class=\"fwb\">Get fresher food</span><br><span class=\"text-thm fw400\">every days</span>","sub_title":"All natural products ","image":'. $freshen_home_2['freshen-banner-slider-1'] .',"sub_text":"<span class=\"fwb\">Organic food</span> is food produced by methods that comply with the <br> standards of organic farming.","btn_shop_now":"SHOP NOW","link_shop_now":"#"},{"_active":true,"title":"<span class=\"fwb\">Healthy Food</span><br><span class=\"text-thm fw400\">&amp; Organic Market</span>","sub_title":"<span class=\"fwb\">Organic food</span> is food produced by methods that comply with the <br> standards of organic farming.","image":'. $freshen_home_2['freshen-banner-slider-1'] .',"sub_text":"All natural products ","btn_shop_now":"SHOP NOW","link_shop_now":"#"}],"sliders_2":[{"_active":true,"title":"Up To Breads ","sub_title":"SEASONAL SALE","image":'. $freshen_home_2['freshen-banner-slider-2'] .',"sub_text":"50% OFF","btn_shop_now":"SHOP NOW","link_shop_now":"#"},{"_active":true,"title":"Fresh Vegetables","sub_title":"Tasty Healthy","image":'. $freshen_home_2['freshen-banner-slider-3'] .',"sub_text":"","btn_shop_now":"SHOP NOW","link_shop_now":"#"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"why_chose_us","name":"Why Chose Us","model":{"title":"","list_items":[{"_active":true,"title":"WE DRIVE FAST & SHIP FASTER","desc":"Sed semper convallis ultricies. Aliqua erat vol esent friday ngilla augue","image_id":'. $freshen_home_2['freshen-why-chose-1'] .'},{"_active":true,"title":"WE SAVE YOUR MORE MONEY","desc":"Sed semper convallis ultricies. Aliqua erat vol esent friday ngilla augue.","image_id":'. $freshen_home_2['freshen-why-chose-2'] .'},{"_active":true,"title":"DAILY DISCOUNT COUPONS","desc":"Sed semper convallis ultricies. Aliqua erat vol esent friday ngilla augue.","image_id":'. $freshen_home_2['freshen-why-chose-3'] .'}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"product_in_category","name":"Product: In Category","model":{"style":"style_1","title":"FRUITS","category_id":"","number":6,"order":"id","order_by":"desc","load_more_url":"#","load_more_name":"VIEW ALL","bg_image":'. $freshen_home_2['banner-1'] .',"bg_title":"FRESH SUMMER WITH JUST $200.99","bg_sub_title":"FRESH FRUIT","link_apply":"SHOP NOW","url_apply":"#"},"component":"RegularBlock","open":true,"is_container":false},{"type":"product_in_category","name":"Product: In Category","model":{"style":"style_1","title":"VEGETABLES","category_id":"","number":6,"order":"id","order_by":"desc","load_more_url":"#","load_more_name":"VIEW ALL","bg_image":'. $freshen_home_2['banner-2'] .',"bg_title":"FRESH VEGETABLES","bg_sub_title":"TASTY HEALTHY","link_apply":"SHOP NOW","url_apply":"#"},"component":"RegularBlock","open":true,"is_container":false},{"type":"product_in_category","name":"Product: In Category","model":{"style":"style_1","title":"FOOD & GROCERY","category_id":"","number":6,"order":"id","order_by":"desc","load_more_url":"#","load_more_name":"VIEW ALL","bg_image":'. $freshen_home_2['banner-3'] .',"bg_title":"SEASON DISCOUNT","bg_sub_title":"20% OFF","link_apply":"SHOP NOW","url_apply":"#"},"component":"RegularBlock","open":true}]',
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );
        // Freshen home page 2
        $freshen_page2_id = DB::table('core_pages')->insertGetId([
            'title'       => 'Freshen Home Page 2',
            'slug'        => 'freshen-home-page-2',
            'template_id' => $freshen_templlate2_id,
            'show_template' => 1,
            'author_id' => 1,
            'create_user' => '1',
            'status'      => 'publish',
            'created_at'  => date("Y-m-d H:i:s")
        ]);

        DB::table('core_page_meta')->insert([[
            'parent_id'       => $freshen_page2_id,
            'name'        => 'header_style',
            'val' => '2',
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ],[
            'parent_id'       => $freshen_page2_id,
            'name'        => 'footer_style',
            'val' => '2',
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]]);

        // Freshen home page 3 template
        $freshen_home_3 = [
            'freshen-banner-slider-1'=> MediaFile::updateOrCreate(['file_name' => 'banner-slider-5', 'file_path' => 'freshen/general/banner-slider-5.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'banner-slider-5'])->id,
            'freshen-banner-slider-2'=> MediaFile::updateOrCreate(['file_name' => 'banner-slider-6', 'file_path' => 'freshen/general/banner-slider-6.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'banner-slider-6'])->id,
            'freshen-promotion-1'=> MediaFile::updateOrCreate(['file_name' => 'freshen-promotion-5', 'file_path' => 'freshen/general/promotion-5.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'freshen-promotion-5'])->id,
            'freshen-promotion-2'=> MediaFile::updateOrCreate(['file_name' => 'freshen-promotion-4', 'file_path' => 'freshen/general/promotion-4.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'freshen-promotion-4'])->id,
            'freshen-cate-1'=> MediaFile::updateOrCreate(['file_name' => 'cate-1', 'file_path' => 'freshen/general/cate-1.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'cate-1'])->id,
            'freshen-cate-2'=> MediaFile::updateOrCreate(['file_name' => 'cate-1', 'file_path' => 'freshen/general/cate-2.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'cate-2'])->id,
            'freshen-cate-3'=> MediaFile::updateOrCreate(['file_name' => 'cate-1', 'file_path' => 'freshen/general/cate-3.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'cate-3'])->id,
            'freshen-cate-4'=> MediaFile::updateOrCreate(['file_name' => 'cate-1', 'file_path' => 'freshen/general/cate-4.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'cate-4'])->id,
            'freshen-cate-5'=> MediaFile::updateOrCreate(['file_name' => 'cate-1', 'file_path' => 'freshen/general/cate-5.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'cate-5'])->id,
            'freshen-cate-6'=> MediaFile::updateOrCreate(['file_name' => 'cate-1', 'file_path' => 'freshen/general/cate-6.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'cate-6'])->id,
        ];

        $freshen_templlate3_id = DB::table('core_templates')->insertGetId(
            [
                'title' =>  'Freshen Home Page 3',
                'content'   =>  '[{"type":"banner_slider","name":"Banner Slider","model":{"width_slider":"slider-fluid","sliders":[{"_active":true,"title":"<span class=\"fwb\">Up To Breads</span><br><span class=\"text-thm3\">50% Off</span>","sub_title":"All natural products","image":'. $freshen_home_3['freshen-banner-slider-1'] .',"sub_text":"<span class=\"fwb\">Organic food</span> is food produced by methods that comply with the <br> standards of organic farming.","btn_shop_now":"Shop Now","link_shop_now":"#"},{"_active":true,"title":"<span class=\"fwb\">Healthy Food</span><br><span class=\"text-thm3\">every days</span>","sub_title":"All natural products","image":'. $freshen_home_3['freshen-banner-slider-2'] .',"sub_text":"<span class=\"fwb\">Organic food</span> is food produced by methods that comply with the <br> standards of organic farming.","btn_shop_now":"Shop Now","link_shop_now":"#"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"featured_icon","name":"Featured Icon","model":{"list_items":[{"_active":true,"title":"Free Delivery","sub_title":"For all oders over $99","icon":"flaticon-fast text-thm3"},{"_active":true,"title":"Secure Payment","sub_title":"100% secure payment","icon":"flaticon-customer-1 text-thm3"},{"_active":true,"title":"90 Days Return","sub_title":"If goods have problems","icon":"flaticon-returning text-thm3"},{"_active":true,"title":"24/7 Support","sub_title":"Dedicated support","icon":"flaticon-support text-thm3"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"promotion","name":"Promotion","model":{"title":"","list_items":[{"_active":false,"sub_title":"FRESH FRUIT","title":"FRESH SUMMER WITH JUST $200.99","link":"#","image":'. $freshen_home_3['freshen-promotion-1'] .'},{"_active":true,"sub_title":"TASTY HEALTHY","title":"FRESH VEGETABLES","link":"#","image":'. $freshen_home_3['freshen-promotion-2'] .'}],"style":"style_2"},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_category_product","name":"Product: List Tab Category","model":{"title":"FEATURED PRODUCTS","cat_ids":["9","8","7","6"],"number":10,"order":"id","order_by":"desc"},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_category","name":"List Category","model":{"title":"CATEGORIES","style":"style_2","list_items_2":[{"_active":true,"title":"Food & Grocery","image_id":'. $freshen_home_3['freshen-cate-1'] .',"category_ids":["6","7","8","9"],"btn_name":"VIEW ALL","btn_url":"#"},{"_active":true,"title":"Vegetables","image_id":'. $freshen_home_3['freshen-cate-2'] .',"category_ids":["5","6","8","9"],"btn_name":"VIEW ALL","btn_url":"#"},{"_active":true,"title":"Fruits","image_id":'. $freshen_home_3['freshen-cate-3'] .',"category_ids":["1","3","4","5"],"btn_name":"VIEW ALL","btn_url":"#"},{"_active":true,"title":"Sea Food","image_id":'. $freshen_home_3['freshen-cate-4'] .',"category_ids":["6","8","5","4"],"btn_name":"VIEW ALL","btn_url":"#"},{"_active":true,"title":"Bakery","image_id":'. $freshen_home_3['freshen-cate-5'] .',"category_ids":["4","5","6","8"],"btn_name":"VIEW ALL","btn_url":"#"},{"_active":true,"title":"Fresh Meat","image_id":'. $freshen_home_3['freshen-cate-6'] .',"category_ids":["5","7","6","3"],"btn_name":"VIEW ALL","btn_url":"#"}],"btn_name":"VIEW ALL","btn_url":"#"},"component":"RegularBlock","open":true,"is_container":false},{"type":"whats_app","name":"Whats App","model":{"style":"style_1","title":"Whatsapp Ordering Service","icon":"flaticon-whatsapp","title2":"Place Your Orders At +1 246-345-0695"},"component":"RegularBlock","open":true}]',
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );
        // Freshen home page 3
        $freshen_page3_id = DB::table('core_pages')->insertGetId([
            'title'       => 'Freshen Home Page 3',
            'slug'        => 'freshen-home-page-3',
            'template_id' => $freshen_templlate3_id,
            'show_template' => 1,
            'author_id' => 1,
            'create_user' => '1',
            'status'      => 'publish',
            'created_at'  => date("Y-m-d H:i:s")
        ]);
        DB::table('core_page_meta')->insert([[
            'parent_id'       => $freshen_page3_id,
            'name'        => 'header_style',
            'val' => '3',
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ],[
            'parent_id'       => $freshen_page3_id,
            'name'        => 'footer_style',
            'val' => '3',
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]]);

        // Freshen home page 4 template
        $freshen_home_4 = [
            'freshen-banner-slider-1'=> MediaFile::updateOrCreate(['file_name' => 'banner-home4-1', 'file_path' => 'freshen/general/banner-home4-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'banner-home4-1'])->id,
            'freshen-banner-slider-2'=> MediaFile::updateOrCreate(['file_name' => 'banner-style-4-1', 'file_path' => 'freshen/shop-items/banner-style-4-1.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'banner-style-4-1'])->id,
            'freshen-banner-slider-3'=> MediaFile::updateOrCreate(['file_name' => 'banner-style-4-2', 'file_path' => 'freshen/shop-items/banner-style-4-2.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'banner-style-4-2'])->id,
            'freshen-banner-slider-4'=> MediaFile::updateOrCreate(['file_name' => 'banner-style-4-3', 'file_path' => 'freshen/shop-items/banner-style-4-3.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'banner-style-4-3'])->id,
            'freshen-banner-slider-5'=> MediaFile::updateOrCreate(['file_name' => 'fp7', 'file_path' => 'freshen/shop-items/fp7.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'fp7'])->id,
            'freshen-banner-slider-6'=> MediaFile::updateOrCreate(['file_name' => 'banner-style4-4', 'file_path' => 'freshen/shop-items/banner-style4-4.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'banner-style4-4'])->id,
            'freshen-cate-1'=> MediaFile::updateOrCreate(['file_name' => 'medium1', 'file_path' => 'freshen/general/medium1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'medium1'])->id,
            'freshen-cate-2'=> MediaFile::updateOrCreate(['file_name' => 'medium2', 'file_path' => 'freshen/general/medium3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'medium2'])->id,
            'freshen-cate-3'=> MediaFile::updateOrCreate(['file_name' => 'medium3', 'file_path' => 'freshen/general/medium3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'medium3'])->id,
        ];

        $freshen_templlate4_id = DB::table('core_templates')->insertGetId(
            [
                'title' =>  'Freshen Home Page 4',
                'content'   =>  '[{"type":"banner_slider_v2","name":"Banner Slider V2","model":{"style":"style_2","sliders":[{"_active":true,"title":"Organic Food Good","sub_title":"Meat","image":'. $freshen_home_4['freshen-banner-slider-1'] .',"sub_text":null,"btn_shop_now":"Shop Now","link_shop_now":"#"},{"_active":true,"title":"Healthy Food","sub_title":"Meat","image":'. $freshen_home_4['freshen-banner-slider-1'] .',"sub_text":null,"btn_shop_now":"Shop Now","link_shop_now":"#"}],"sliders_2":[{"_active":false,"title":"Season Discount","sub_title":"$29.99","image":'. $freshen_home_4['freshen-banner-slider-6'] .',"sub_text":null,"btn_shop_now":"Shop Now","link_shop_now":"#"},{"_active":false,"title":"Sale 70 % Off","sub_title":"This Week","image":'. $freshen_home_4['freshen-banner-slider-5'] .',"sub_text":null,"btn_shop_now":"Shop Now","link_shop_now":"#"},{"_active":false,"title":"Vegetables &","sub_title":"Fruits","image":'. $freshen_home_4['freshen-banner-slider-2'] .',"sub_text":null,"btn_shop_now":"Shop Now","link_shop_now":"#"},{"_active":false,"title":"Healthy Food","sub_title":"& Organic Market","image":'. $freshen_home_4['freshen-banner-slider-3'] .',"sub_text":null,"btn_shop_now":"Shop Now","link_shop_now":"#"},{"_active":false,"title":"Today","sub_title":"Discount","image":'. $freshen_home_4['freshen-banner-slider-4'] .',"sub_text":null,"btn_shop_now":"Shop Now","link_shop_now":"#"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"featured_icon","name":"Featured Icon","model":{"list_items":[{"_active":true,"title":"Free Delivery","sub_title":"For all oders over $99","icon":"flaticon-fast text-thm"},{"_active":true,"title":"Secure Payment","sub_title":"100% secure payment","icon":"flaticon-customer-1 text-thm"},{"_active":true,"title":"90 Days Return","sub_title":"If goods have problems","icon":"flaticon-returning text-thm"},{"_active":true,"title":"24/7 Support","sub_title":"Dedicated support","icon":"flaticon-support text-thm"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_category_product","name":"Product: List Tab Category","model":{"style":"style_2","title":"Featured Products","cat_ids":["8","5","6","1","2","3","4","9"],"number":15,"order":"id","order_by":"desc"},"component":"RegularBlock","open":true,"is_container":false},{"type":"product_in_category","name":"Product: In Category","model":{"style":"style_2","title":"Fruits","category_id":"1","number":5,"order":"id","order_by":"desc","load_more_url":"#","load_more_name":"View All","bg_image":'. $freshen_home_4['freshen-cate-1'] .',"bg_title":"Fresh Summer With Just $200.99","bg_sub_title":"FRESH FRUIT","link_apply":"SHOP NOW","url_apply":"#","text_class":""},"component":"RegularBlock","open":true,"is_container":false},{"type":"product_in_category","name":"Product: In Category","model":{"style":"style_2","title":"Vegetables","category_id":"2","number":5,"order":"id","order_by":"desc","load_more_url":"#","load_more_name":"View All","bg_image":'. $freshen_home_4['freshen-cate-2'] .',"bg_title":"Fresh Vegetables","bg_sub_title":"TASTY HEALTHY","link_apply":"SHOP NOW","url_apply":"#","text_class":"text-white"},"component":"RegularBlock","open":true,"is_container":false},{"type":"product_in_category","name":"Product: In Category","model":{"style":"style_2","title":"Food & Grocery","category_id":"6","number":5,"order":"id","order_by":"desc","load_more_url":"#","load_more_name":"View All","bg_image":'. $freshen_home_4['freshen-cate-3'] .',"bg_title":"Season Discount","bg_sub_title":"20% OFF","link_apply":"SHOP NOW","url_apply":"#","text_class":"text-white"},"component":"RegularBlock","open":true,"is_container":false},{"type":"subscribe","name":"Subscribe","model":{"style":"style_1","title":"SIGN UP FOR NEWSLETTER","sub_title":"Subscribe to the weekly newsletter for all the latest updates","btn_name":"Subscribe"},"component":"RegularBlock","open":true,"is_container":false}]',
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );
        // Freshen home page 4
        $freshen_page4_id = DB::table('core_pages')->insertGetId([
            'title'       => 'Freshen Home Page 4',
            'slug'        => 'freshen-home-page-4',
            'template_id' => $freshen_templlate4_id,
            'show_template' => 1,
            'author_id' => 1,
            'create_user' => '1',
            'status'      => 'publish',
            'created_at'  => date("Y-m-d H:i:s")
        ]);
        DB::table('core_page_meta')->insert([[
            'parent_id'       => $freshen_page4_id,
            'name'        => 'header_style',
            'val' => '4',
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ],[
            'parent_id'       => $freshen_page4_id,
            'name'        => 'footer_style',
            'val' => '4',
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]]);

        $freshen_page_about = [
            'freshen-about-1'=> MediaFile::updateOrCreate(['file_name' => 'about-1', 'file_path' => 'freshen/general/about-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'about-1'])->id,
            'freshen-about-2'=> MediaFile::updateOrCreate(['file_name' => 'about-2', 'file_path' => 'freshen/general/about-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'about-2'])->id,
            'freshen-testimonial-1'=> MediaFile::updateOrCreate(['file_name' => 'testimonial-1', 'file_path' => 'freshen/general/testimonial-1.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'testimonial-1'])->id,
            'freshen-testimonial-2'=> MediaFile::updateOrCreate(['file_name' => 'testimonial-2', 'file_path' => 'freshen/general/testimonial-2.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'testimonial-2'])->id,
            'freshen-testimonial-3'=> MediaFile::updateOrCreate(['file_name' => 'testimonial-3', 'file_path' => 'freshen/general/testimonial-3.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'testimonial-3'])->id,
            'freshen-testimonial-4'=> MediaFile::updateOrCreate(['file_name' => 'testimonial-4', 'file_path' => 'freshen/general/testimonial-4.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'testimonial-4'])->id,
            'freshen-testimonial-5'=> MediaFile::updateOrCreate(['file_name' => 'testimonial-5', 'file_path' => 'freshen/general/testimonial-5.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'testimonial-5'])->id,
            'freshen-testimonial-6'=> MediaFile::updateOrCreate(['file_name' => 'testimonial-6', 'file_path' => 'freshen/general/testimonial-6.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'testimonial-6'])->id,
        ];
        $freshen_page_about_id = DB::table('core_templates')->insertGetId([
                'title'       => 'Freshen About Us',
                'content'     => '[{"type":"breadcrumb","name":"Breadcrumb","model":{"list_items":[{"_active":true,"name":"ABOUT US","url":null}],"title":"ABOUT US"},"component":"RegularBlock","open":true,"is_container":false},{"type":"about_text","name":"About Text","model":{"title":"SAVE MORE WITH FRESHEN ! WE GIVE YOU THE LOWEST PRICES ON ALL YOUR GROCERY NEEDS.","list_items":[{"_active":true,"title":"Our Vision","desc":"Essentially, the good stuff is right here. We source the best suppliers and makers of natural and organic products that you won’t find on the high street. If you care about how things get made and what’s in them, we bring you products created with care."},{"_active":true,"title":"Our Vision","desc":"Essentially, the good stuff is right here. We source the best suppliers and makers of natural and organic products that you won’t find on the high street. If you care about how things get made and what’s in them, we bring you products created with care."}],"youtbe":"https://www.youtube.com/watch?v=R7xbhKIiw4Y","image_1":'.$freshen_page_about['freshen-about-1'].',"image_2":'.$freshen_page_about['freshen-about-2'].',"youtube":"https://www.youtube.com/watch?v=R7xbhKIiw4Y"},"component":"RegularBlock","open":true,"is_container":false},{"type":"why_chose_us","name":"Why Chose Us","model":{"title":"WHY CHOOSE US","list_items":[{"_active":true,"title":"WE DRIVE FAST & SHIP FASTER","desc":"Sed semper convallis ultricies. Aliqua erat vol esent friday ngilla augue.","image_id":'. $freshen_home_2['freshen-why-chose-1'] .'},{"_active":true,"title":"WE SAVE YOUR MORE MONEY","desc":"Sed semper convallis ultricies. Aliqua erat vol esent friday ngilla augue.","image_id":'. $freshen_home_2['freshen-why-chose-2'] .'},{"_active":true,"title":"DAILY DISCOUNT COUPONS","desc":"Sed semper convallis ultricies. Aliqua erat vol esent friday ngilla augue.","image_id":'. $freshen_home_2['freshen-why-chose-3'] .'}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"testimonial","name":"Testimonial","model":{"list_items":[{"_active":true,"name":"Wade Warren","desc":"When it comes to immediate body treatment, I know who I can count on. Being an accountant, you sometimes need rest to relieve all the stress and get new energy. I look forward to meeting you again soon","position":"Marketing Coordinator"},{"_active":true,"name":"Wade Warren","desc":"When it comes to immediate body treatment, I know who I can count on. Being an accountant, you sometimes need rest to relieve all the stress and get new energy. I look forward to meeting you again soon","position":"Marketing Coordinator"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"our_teams","name":"Our Teams","model":{"title":"DEAL OF THE WEEK","list_items":[{"_active":true,"name":"Wade Warren","position":"Marketing Coordinator","avatar":'.$freshen_page_about['freshen-testimonial-1'].'},{"_active":true,"name":"Floyd Miles","position":"Web Designer","avatar":'.$freshen_page_about['freshen-testimonial-2'].'},{"_active":true,"name":"Brooklyn Simmons","position":"Nursing Assistant","avatar":'.$freshen_page_about['freshen-testimonial-3'].'},{"_active":true,"name":"Ralph Edwards","position":"Marketing Coordinator","avatar":'.$freshen_page_about['freshen-testimonial-4'].'},{"_active":true,"name":"Leslie Alexander","position":"Dog Trainer","avatar":'.$freshen_page_about['freshen-testimonial-5'].'},{"_active":true,"name":"Eleanor Pena","position":"President of Sales","avatar":'.$freshen_page_about['freshen-testimonial-6'].'}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_logos","name":"List Logo(s)","model":{"list_items":[{"_active":true,"image":'.$freshen_home_1['freshen-logo-partner-1'].'},{"_active":true,"image":'.$freshen_home_1['freshen-logo-partner-2'].'},{"_active":false,"image":'.$freshen_home_1['freshen-logo-partner-3'].'},{"_active":false,"image":'.$freshen_home_1['freshen-logo-partner-4'].'},{"_active":false,"image":'.$freshen_home_1['freshen-logo-partner-5'].'},{"_active":false,"image":'.$freshen_home_1['freshen-logo-partner-2'].'}]},"component":"RegularBlock","open":true}]',
                'create_user' => '1',
                'created_at'  => date("Y-m-d H:i:s")
            ]);
        DB::table('core_pages')->insertGetId([
            'title'         => 'Freshen About Us',
            'slug'          => 'freshen-about-us',
            'template_id'   => $freshen_page_about_id,
            'show_template' => 1,
            'author_id'     => 1,
            'create_user'   => '1',
            'status'        => 'publish',
            'created_at'    => date("Y-m-d H:i:s")
        ]);

        $freshen_contact_id = DB::table('core_templates')->insertGetId([
            'title'       => 'Freshen Contact',
            'content'     => '[{"type":"breadcrumb","name":"Breadcrumb","model":{"title":"CONTACT US","list_items":[{"_active":true,"name":"CONTACT US","url":"#"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"featured_icon","name":"Featured Icon","model":{"list_items":[{"_active":true,"title":"OUR STORE","sub_title":"Collins Street West, Victoria 8007, Australia.","icon":"flaticon-map"},{"_active":true,"title":"HOTLINE","sub_title":"+ (315) 905-2321","icon":"flaticon-phone-call"},{"_active":true,"title":"EMAIL CONTACT","sub_title":"order@freshen.com","icon":"flaticon-email"},{"_active":true,"title":"Working Hours","sub_title":"Mon-Fri: 8 AM - 5 PM  <br>  Sat-Sun: 8 AM - 2 PM","icon":"flaticon-wall-clock"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"contact_block","name":"Contact Block","model":{"class":"","title":"Let\'s get in touch","right_title":"Get in touch","sub_title":"We\'re open for any suggestion or just to have a chat","address":"198 West 21th Street, Suite 721 New York NY 10016","phone":"1234 5678 89","email":"contact@becommerce.test","website":"yoursite.com"},"component":"RegularBlock","open":true,"is_container":false}]',
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]);
        DB::table('core_pages')->insertGetId([
            'title'         => 'Freshen Contact',
            'slug'          => 'freshen-contact',
            'template_id'   => $freshen_contact_id,
            'show_template' => 1,
            'author_id'     => 1,
            'create_user'   => '1',
            'status'        => 'publish',
            'created_at'    => date("Y-m-d H:i:s")
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
