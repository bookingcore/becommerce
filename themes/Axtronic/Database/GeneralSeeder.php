<?php
namespace Themes\Axtronic\Database;
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
                        "url" => "/page/axtronic-home-page-1",
                        "item_model" => "custom",
                        "_open" => false,
                        "model_name" => "Custom",
                        "is_removed" => true
                    ],
                    [
                        "name" => "Home Page 2",
                        "url" => "/page/axtronic-home-page-2",
                        "item_model" => "custom",
                        "_open" => false,
                        "model_name" => "Custom",
                        "is_removed" => true
                    ],
                    [
                        "name" => "Home Page 3",
                        "url" => "/page/axtronic-home-page-3",
                        "item_model" => "custom",
                        "_open" => false,
                        "model_name" => "Custom",
                        "is_removed" => true
                    ],
                    [
                        "name" => "Home Page 4",
                        "url" => "/page/axtronic-home-page-4",
                        "item_model" => "custom",
                        "_open" => false,
                        "model_name" => "Custom",
                        "is_removed" => true
                    ],
                    [
                        "name" => "Home Page 5",
                        "url" => "/page/axtronic-home-page-5",
                        "item_model" => "custom",
                        "_open" => false,
                        "model_name" => "Custom",
                        "is_removed" => true
                    ],
                    [
                        "name" => "Home Page 6",
                        "url" => "/page/axtronic-home-page-6",
                        "item_model" => "custom",
                        "_open" => false,
                        "model_name" => "Custom",
                        "is_removed" => true
                    ],
                    [
                        "name" => "Home Page 7",
                        "url" => "/page/axtronic-home-page-7",
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
                        "url" => "/category/gaming-pc",
                        "item_model" => "custom",
                        "_open" => false,
                        "model_name" => "Custom",
                        "is_removed" => true
                    ],

                    [
                        "name" => "Simple Product",
                        "url" => "/product/bluetooth-speaker-jbl-flip-5",
                        "item_model" => "custom",
                        "_open" => false,
                        "model_name" => "Custom",
                        "is_removed" => true
                    ],
                    [
                        "name" => "Variable Product",
                        "url" => "product/apple-iphone-13-128gb",
                        "item_model" => "custom",
                        "_open" => false,
                        "model_name" => "Custom",
                        "is_removed" => true
                    ],
//                    [
//                        "name" => "Affiliate Product",
//                        "url" => "/product/augason-farms-freeze-dried-beef-chunks",
//                        "item_model" => "custom",
//                        "_open" => false,
//                        "model_name" => "Custom",
//                        "is_removed" => true
//                    ],
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
                        "url" => "/page/axtronic-about-us",
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
                "url" => "/page/axtronic-contact",
                "item_model" => "custom",
                "_open" => false,
                "target" => "",
            ]
        ];
        //Menu
        $menu_id = DB::table('core_menus')->insertGetId(
            [
                'name'  => "axtronic Menu",
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

        $logo_light = MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-light', 'file_path' => 'axtronic/logo-white.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-light']);
        $logo_dark = MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-dark', 'file_path' => 'axtronic/logo-dark.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-dark']);
        $bg_footer_1 = MediaFile::updateOrCreate(['file_name' => 'axtronic-bg-footer-1', 'file_path' => 'axtronic/bg-subcribeform.jpg', 'file_type' => 'image/jpg', 'file_extension' => 'png'],['file_name' => 'axtronic-bg-footer-1']);
        setting_update_items(
            [
                [
                    'name'  => 'axtronic_logo_light',
                    'val'   => $logo_light->id,
                ],
                [
                    'name'  => 'axtronic_logo_dark',
                    'val'   => $logo_dark->id,
                ],
                [
                    'name'  => 'axtronic_header_contact',
                    'val'   => 'Find all you need here!',
                ],
                [
                    'name'  => 'axtronic_hotline_contact',
                    'val'   => '+84 2500 888 33',
                ],
                [
                    'name'  => 'axtronic_hotline_text',
                    'val'   => 'Need help? Call Us:',
                ],
                [
                    'name'  => 'axtronic_email_contact',
                    'val'   => 'order@axtronic.com',
                ],
                [
                    'name'  => 'axtronic_footer_style',
                    'val'   => 'style_1',
                ],
                [
                    'name'  => 'axtronic_header_style',
                    'val'   => '1',
                ],
                [
                    'name'  => 'axtronic_footer_bg_image',
                    'val'   => $bg_footer_1->id,
                ],
                [
                    'name'  => 'axtronic_footer_text_subscribe',
                    'val'   => '<h3 class="c-main fw-bold">Subscribe to our Email</h3>
                        <p>For lastest News & Updates</p>',
                ],
                [
                    'name'  => 'axtronic_list_widget_footer',
                    'val'   => '[{"title":"Quick Links","size":"4","content":"<ul class=\"list-items\">\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">Home<\/span>\r\n<\/a>\r\n<\/li>\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">Products<\/span>\r\n<\/a>\r\n<\/li>\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">Brands<\/span>\r\n<\/a>\r\n<\/li>\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">Hot Deal<\/span>\r\n<\/a>\r\n<\/li>\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">Blog<\/span>\r\n<\/a>\r\n<\/li>\r\n<\/ul>"},{"title":"My Account","size":"4","content":"<ul class=\"list-items\">\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">My Profile<\/span>\r\n<\/a>\r\n<\/li>\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">My Order History<\/span>\r\n<\/a>\r\n<\/li>\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">My Wishlist<\/span>\r\n<\/a>\r\n<\/li>\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">Order Tracking<\/span>\r\n<\/a>\r\n<\/li>\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">Shopping Cart<\/span>\r\n<\/a>\r\n<\/li>\r\n<\/ul>"},{"title":"Company","size":"4","content":"<ul class=\"list-items\">\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">About Us<\/span>\r\n<\/a>\r\n<\/li>\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">Careers<\/span>\r\n<\/a>\r\n<\/li>\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">Blog<\/span>\r\n<\/a>\r\n<\/li>\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">Affiliate<\/span>\r\n<\/a>\r\n<\/li>\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">Contact Us<\/span>\r\n<\/a>\r\n<\/li>\r\n<\/ul>"}]',
                ],
                [
                    'name'  => 'axtronic_footer_info_text',
                    'val'   => '<h5 >8 (844) 880 - 33388</h5>
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna',
                ],
                [
                    'name'  => 'axtronic_footer_text_right',
                    'val'   => '',
                ],
                [
                    'name'  => 'axtronic_copyright',
                    'val'   => 'Copyright © 2022 <a href="#">Axtronic </a> | Powered by Axtronic',
                ],
            ]
        );

        $axtronic_home_1 = [
            'axtronic-banner-slider-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-slider-1', 'file_path' => 'axtronic/mainslider-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-slider-1'])->id,
            'axtronic-banner-slider-2'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-slider-2', 'file_path' => 'axtronic/mainslider-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-slider-2'])->id,
            'axtronic-banner-slider-3'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-slider-3', 'file_path' => 'axtronic/mainslider-3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-slider-3'])->id,

            'axtronic-promotion-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-promotion-1', 'file_path' => 'axtronic/promotion/banner1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-promotion-1'])->id,
            'axtronic-promotion-2'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-promotion-2', 'file_path' => 'axtronic/promotion/banner2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-promotion-2'])->id,
            'axtronic-promotion-3'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-promotion-3', 'file_path' => 'axtronic/promotion/banner3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-promotion-3'])->id,
            'axtronic-promotion-4'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-promotion-4', 'file_path' => 'axtronic/promotion/banner4.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-promotion-4'])->id,
            'axtronic-promotion-5'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-promotion-5', 'file_path' => 'axtronic/promotion/banner5.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-promotion-5'])->id,
            'axtronic-promotion-6'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-promotion-6', 'file_path' => 'axtronic/promotion/banner6.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-promotion-6'])->id,
            'axtronic-promotion-7'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-promotion-7', 'file_path' => 'axtronic/promotion/h1-bannernew-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-promotion-7'])->id,
            'axtronic-promotion-8'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-promotion-8', 'file_path' => 'axtronic/promotion/h1-bannernew-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-promotion-8'])->id,

            'axtronic-product-bg'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-bg', 'file_path' => 'axtronic/bg-bestseller.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-product-bg'])->id,

            'axtronic-banner-bg'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-bg', 'file_path' => 'axtronic/banner1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-bg'])->id,
            'axtronic-banner-image'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-image', 'file_path' => 'axtronic/banner-section-beat.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-banner-image'])->id,

            'axtronic-testimonial-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-testimonial-1', 'file_path' => 'axtronic/avarta1.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-testimonial-1'])->id,
            'axtronic-testimonial-2'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-testimonial-2', 'file_path' => 'axtronic/avarta2.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-testimonial-2'])->id,
            'axtronic-testimonial-3'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-testimonial-3', 'file_path' => 'axtronic/avarta3.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-testimonial-3'])->id,

            'axtronic-logo-partner-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-1', 'file_path' => 'axtronic/partner/partner-1.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-1'])->id,
            'axtronic-logo-partner-2'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-2', 'file_path' => 'axtronic/partner/partner-2.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-2'])->id,
            'axtronic-logo-partner-3'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-3', 'file_path' => 'axtronic/partner/partner-3.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-3'])->id,
            'axtronic-logo-partner-4'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-4', 'file_path' => 'axtronic/partner/partner-4.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-4'])->id,
            'axtronic-logo-partner-5'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-5', 'file_path' => 'axtronic/partner/partner-5.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-5'])->id,
            'axtronic-logo-partner-6'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-6', 'file_path' => 'axtronic/partner/partner-6.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-6'])->id,

        ];
        $templlate_id = DB::table('core_templates')->insertGetId(
            [
                'title' =>  'Axtronic HomePage 1',
                'content'   =>  '[{"type":"banner_slider","name":"Banner Slider","model":{"width_slider":"container","sliders":[{"_active":false,"title":"New arrivals Smartphone","sub_title":"On Sale","image":'.$axtronic_home_1['axtronic-banner-slider-1'].',"sub_text":"<span>original price $799.00</span><br>$550.99","btn_shop_now":"Shop Now","link_shop_now":"#"},{"_active":false,"title":"Best Camera Smartphone","sub_title":"On Sale","image":'.$axtronic_home_1['axtronic-banner-slider-2'].',"sub_text":"<span>original price $799.00</span><br>$550.99","btn_shop_now":"Shop Now","link_shop_now":"#"},{"_active":false,"title":"New arrivals Smartwatch","sub_title":"On Sale","image":'.$axtronic_home_1['axtronic-banner-slider-3'].',"sub_text":"<span>original price $799.00</span><br>$550.99","btn_shop_now":"Shop Now","link_shop_now":"#"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"promotion","name":"Promotion","model":{"title":"","sub_title":"","col":"grid","style":"","list_items":[{"_active":true,"sub_title":"Sound","title":"Headphone","content":"<span>Start from</span><br>$699.00","link":"#","image":'.$axtronic_home_1['axtronic-promotion-1'].',"position":"bottom_left","style_color":"light"},{"_active":true,"sub_title":"Sound","title":"SmartWatch","content":"<span>Start from</span><br>$299.00","link":"#","image":'.$axtronic_home_1['axtronic-promotion-2'].',"position":"bottom_left","style_color":"light"},{"_active":false,"sub_title":"Laptop, PC","title":"Laptop Devices","content":"<span>Starting at</span><br>$499.00","link":"#","image":'.$axtronic_home_1['axtronic-promotion-3'].',"position":"bottom_left","style_color":"light"},{"_active":false,"sub_title":"Laptop, PC","title":"Laptop Devices","content":"<span>Starting at</span><br>$699.00","link":"#","image":'.$axtronic_home_1['axtronic-promotion-4'].',"position":"top_left","style_color":"light"},{"_active":false,"sub_title":"Sound","title":"Headphone","content":"<span>Start from</span><br>$699.00","link":"#","image":'.$axtronic_home_1['axtronic-promotion-5'].',"position":"top_left","style_color":"light"},{"_active":false,"sub_title":"Sound","title":"SmartWatch","content":"<span>Starting at</span><br>$299.00","link":"#","image":'.$axtronic_home_1['axtronic-promotion-6'].',"position":"top_left","style_color":"light"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"featured_icon","name":"Featured Icon","model":{"list_items":[{"_active":false,"title":"Free Shipping","sub_title":"Free shipping on all order","icon":"axtronic-icon-group"},{"_active":true,"title":" Free Shipping","sub_title":"Free shipping on all order","icon":"axtronic-icon-medal-star"},{"_active":true,"title":" Free Shipping","sub_title":"Free shipping on all order","icon":"axtronic-icon-heart-circle"},{"_active":true,"title":" Free Shipping","sub_title":"Free shipping on all order","icon":"axtronic-icon-wallet"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"category_product","name":"Category Product","model":{"title_name":"Category","list_items":[{"_active":true,"category_id":"23","image_id":140,"icon":"axtronic-icon-mobile"},{"_active":true,"category_id":"25","image_id":142,"icon":"axtronic-icon-group"},{"_active":true,"category_id":"28","image_id":138,"icon":"axtronic-icon-mobile"},{"_active":true,"category_id":"27","image_id":143,"icon":"axtronic-icon-group"}],"style":""},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_product","name":"Product: List item","model":{"style_list":"slide_bg","style_header":"style_3","title":"<span>Best</span> Selling","cat_ids":"","number":10,"order":"title","order_by":"asc","is_featured":"","bg_content":'.$axtronic_home_1['axtronic-product-bg'].',"is_dark":false},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_product","name":"Product: List item","model":{"style_list":"slide","style_header":"","title":"Trending Laptops","cat_ids":["47","40","2"],"number":12,"order":"title","order_by":"desc","is_featured":"","bg_content":"","is_dark":true},"component":"RegularBlock","open":true,"is_container":false},{"type":"promotion","name":"Promotion","model":{"title":"","sub_title":"","col":"6","style":"","list_items":[{"_active":true,"sub_title":"Home ","title":"SmartThings Bulb","content":"<span>Start from</span><br>$199.00","link":"#","image":'.$axtronic_home_1['axtronic-promotion-7'].',"position":"center_left","style_color":"dark"},{"_active":true,"sub_title":"Tablet","title":"Xperia Tablet Z2","content":"<span>Starting at</span><br>$199.00","link":"#","image":'.$axtronic_home_1['axtronic-promotion-8'].',"position":"center_left","style_color":"light"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"gap","name":"Gaps","model":{"gap":"30"},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_product","name":"Product: List item","model":{"style_list":"slide","style_header":"","title":"Trending Sound Devices","cat_ids":["46","38","40","2"],"number":12,"order":"id","order_by":"desc","is_featured":"","bg_content":"","is_dark":true},"component":"RegularBlock","open":true,"is_container":false},{"type":"banner_text","name":"Banner Text","model":{"style":"style_2","banner_width":"container","content":"<div class=\"sub-title\"><span>20% OFF</span>  14 Dec to 16 Dec</div>\n<h2>Beats Solo3 <br>  Wireless</h2>\n<div class=\"price\">$320 <span>$400</span></div>","content2":"<span class=\"sub-title\"><span>Special Offer</span></span>\n<h3>Christmas Sale</h3>\n<p> Hurry up. Limited period offer. <br>Best chance to bring Beats Solo3<br> to your home.</p>\n<a href=\"#\" class=\"button item-button\">Shop Now <i class=\"axtronic-icon-angle-right\"></i> </a>\n","bg_content":'.$axtronic_home_1['axtronic-banner-bg'].',"image":'.$axtronic_home_1['axtronic-banner-image'].'},"component":"RegularBlock","open":true,"is_container":false},{"type":"testimonial","name":"Testimonial","model":{"title":"Feedback from Customers","style":"","list_testimonial":[{"_active":false,"title_item":"Jimmy Kimich","job":"Digital Marketer","content":"Ipsum dolor sit amet, consectetur adipiscing elit. Fringilla vel tincidunt ipsum ac. Nam at et id leo pulvinar egestas mi lorem. Adipiscing felis, vel faucibus in.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed..","number_star":5,"image":'.$axtronic_home_1['axtronic-testimonial-3'].'},{"_active":false,"title_item":"Jimmy Kimich","job":"Digital Marketer","content":"Ipsum dolor sit amet, consectetur adipiscing elit. Fringilla vel tincidunt ipsum ac. Nam at et id leo pulvinar egestas mi lorem. Adipiscing felis, vel faucibus in.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed..","number_star":5,"image":'.$axtronic_home_1['axtronic-testimonial-1'].'},{"_active":false,"title_item":"General First Aid","job":"Graphic Designer","content":"Ipsum dolor sit amet, consectetur adipiscing elit. Fringilla vel tincidunt ipsum ac. Nam at et id leo pulvinar egestas mi lorem. Adipiscing felis, vel faucibus in.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed..","number_star":4,"image":'.$axtronic_home_1['axtronic-testimonial-2'].'}],"style_header":"style_3","bg_color":"","is_dark":true},"component":"RegularBlock","open":true,"is_container":false},{"type":"product_feature","name":"Feature Product ","model":{"style_header":"style_3","title":"Special Offer Products","number":12,"order":"id","order_by":"asc","is_featured":true,"bg_content":"","is_dark":true,"bg_color":"#fff","title_content":"Hot Offer","content":"Ipsum dolor sit amet, consectetur adipiscing elit. Fringilla vel tincidunt ipsum ac. Nam at et id leo pulvinar egestas mi lorem","style":"","width_style":"container"},"component":"RegularBlock","open":true,"is_container":false},{"type":"block_news","name":"Recent news","model":{"title":"Recent News","category_id":"","order":"id","order_by":"asc","style_title":"text-center"},"component":"RegularBlock","open":true,"is_container":false},{"type":"brand_slider","name":"Brands","model":{"style":"","brands":[{"_active":true,"title":"1","image":'.$axtronic_home_1['axtronic-logo-partner-1'].',"link_brand":"#"},{"_active":true,"title":"2","image":'.$axtronic_home_1['axtronic-logo-partner-2'].',"link_brand":"#"},{"_active":true,"title":"3","image":'.$axtronic_home_1['axtronic-logo-partner-3'].',"link_brand":"#"},{"_active":true,"title":"4","image":'.$axtronic_home_1['axtronic-logo-partner-4'].',"link_brand":"#"},{"_active":true,"title":"6","image":'.$axtronic_home_1['axtronic-logo-partner-5'].',"link_brand":"#"}],"bg_color":""},"component":"RegularBlock","open":true,"is_container":false}]',
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );
        $homepage_id = DB::table('core_pages')->insertGetId([
            'title'       => 'Axtronic HomePage 1',
            'slug'        => 'Axtronic-home-page-1',
            'template_id' => $templlate_id,
            'show_template' => 1,
            'author_id' => 1,
            'create_user' => '1',
            'status'      => 'publish',
            'created_at'  => date("Y-m-d H:i:s")
        ]);
        setting_update_item('home_page_id',$homepage_id);

        //Axtronic home layout 2
        $axtronic_home_2 = [
            'axtronic-banner-slider-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-slider-1', 'file_path' => 'axtronic/mainslider-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-slider-1'])->id,
            'axtronic-banner-slider-2'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-slider-2', 'file_path' => 'axtronic/mainslider-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-slider-2'])->id,
            'axtronic-banner-slider-3'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-slider-3', 'file_path' => 'axtronic/mainslider-3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-slider-3'])->id,

            'axtronic-promotion-9'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-promotion-9', 'file_path' => 'axtronic/promotion/h2-banner1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-promotion-9'])->id,
            'axtronic-promotion-10'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-promotion-10', 'file_path' => 'axtronic/promotion/h2-banner2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-promotion-10'])->id,
            'axtronic-promotion-11'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-promotion-11', 'file_path' => 'axtronic/promotion/h2-banner3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-promotion-11'])->id,

            'axtronic-banner-bg-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-section-1', 'file_path' => 'axtronic/banner-section-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-section-1'])->id,

            'axtronic-testimonial-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-testimonial-1', 'file_path' => 'axtronic/avarta1.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-testimonial-1'])->id,
            'axtronic-testimonial-2'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-testimonial-2', 'file_path' => 'axtronic/avarta2.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-testimonial-2'])->id,
            'axtronic-testimonial-3'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-testimonial-3', 'file_path' => 'axtronic/avarta3.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-testimonial-3'])->id,

            'axtronic-logo-partner-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-1', 'file_path' => 'axtronic/partner/partner-1.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-1'])->id,
            'axtronic-logo-partner-2'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-2', 'file_path' => 'axtronic/partner/partner-2.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-2'])->id,
            'axtronic-logo-partner-3'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-3', 'file_path' => 'axtronic/partner/partner-3.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-3'])->id,
            'axtronic-logo-partner-4'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-4', 'file_path' => 'axtronic/partner/partner-4.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-4'])->id,
            'axtronic-logo-partner-5'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-5', 'file_path' => 'axtronic/partner/partner-5.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-5'])->id,
            'axtronic-logo-partner-6'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-6', 'file_path' => 'axtronic/partner/partner-6.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-6'])->id,

            ];
        // Axtronic home page 2 template
        $axtronic_templlate_2_id = DB::table('core_templates')->insertGetId(
            [
                'title' =>  'Axtronic HomePage 2',
                'content'   =>  '[{"type":"banner_slider","name":"Banner Slider","model":{"width_slider":"slider-fluid","sliders":[{"_active":false,"title":"New arrivals Smartphone","sub_title":"On Sale","image":'.$axtronic_home_2['axtronic-banner-slider-1'].',"sub_text":"<span>original price $799.00</span><br>$550.99","btn_shop_now":"Shop Now","link_shop_now":"#"},{"_active":false,"title":"Best Camera Smartphone","sub_title":"On Sale","image":'.$axtronic_home_2['axtronic-banner-slider-2'].',"sub_text":"<span>original price $799.00</span><br>$550.99","btn_shop_now":"Shop Now","link_shop_now":"#"},{"_active":false,"title":"New arrivals Smartwatch","sub_title":"Sound","image":'.$axtronic_home_2['axtronic-banner-slider-3'].',"sub_text":"<span>original price $799.00</span><br>$550.99","btn_shop_now":"Shop Now","link_shop_now":"#"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"featured_icon","name":"Featured Icon","model":{"list_items":[{"_active":true,"title":"Free Shipping","sub_title":"Free shipping on all order","icon":"axtronic-icon-group"},{"_active":true,"title":"Free Shipping","sub_title":"Free shipping on all order","icon":"axtronic-icon-medal-star"},{"_active":true,"title":"Free Shipping","sub_title":"Free shipping on all order","icon":"axtronic-icon-heart-circle"},{"_active":true,"title":"Free Shipping","sub_title":"Free shipping on all order","icon":"axtronic-icon-wallet"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"promotion","name":"Promotion","model":{"title":"","sub_title":"","col":"4","style":"style_2","list_items":[{"_active":false,"sub_title":"Gaming","title":"Gaming Console ","content":"<span>Start from</span><br>$699.00","link":"#","image":'.$axtronic_home_2['axtronic-promotion-9'].',"position":"center_left","style_color":"dark"},{"_active":false,"sub_title":"Sound","title":"House Entertainment","content":"<span>Start from</span><br>$299.00","link":"#","image":'.$axtronic_home_2['axtronic-promotion-10'].',"position":"center_left","style_color":"dark"},{"_active":false,"sub_title":"Laptop, PC","title":"Office Laptop","content":"<span>Start from</span><br>$499.00","link":"#","image":32,"position":"center_left","style_color":"dark"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"product_tab","name":"Product Tab","model":{"style_list":"style_1","title":"","number":12,"is_latest":true,"is_featured":true,"is_rate":true,"order_by":"asc"},"component":"RegularBlock","open":true},{"type":"banner_text","name":"Banner Text","model":{"style":"","banner_width":"banner_fluid","content":"<div class=\"sub-title\">Smart performance</div>\n<h1 class=\"c-main\">Briliant visual</h1>\n<a href=\"#\" class=\"item-link\">Discover Now <i class=\"axtronic-icon-angle-right\"></i> </a>","content2":"","image":"","bg_content":'.$axtronic_home_2['axtronic-banner-bg-1'].'},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_product","name":"Product: List item","model":{"style_list":"slide","style_header":"","title":"Trending Sound Devices","cat_ids":["40","39","37"],"number":"","order":"","order_by":"","is_featured":"","bg_content":"","is_dark":""},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_product","name":"Product: List item","model":{"style_list":"","style_header":"","title":"Trending Cellphones","cat_ids":["40","39","37","38","42"],"number":"","order":"","order_by":"","is_featured":"","bg_content":"","is_dark":""},"component":"RegularBlock","open":true,"is_container":false},{"type":"brand_slider","name":"Brands","model":{"style":"style_2","brands":[{"_active":true,"title":"1","image":'.$axtronic_home_2['axtronic-logo-partner-1'].',"link_brand":"#"},{"_active":true,"title":"2","image":'.$axtronic_home_2['axtronic-logo-partner-2'].',"link_brand":"#"},{"_active":true,"title":"3","image":'.$axtronic_home_2['axtronic-logo-partner-3'].',"link_brand":null},{"_active":true,"title":"4","image":'.$axtronic_home_2['axtronic-logo-partner-4'].',"link_brand":"#"},{"_active":true,"title":"5","image":'.$axtronic_home_2['axtronic-logo-partner-5'].',"link_brand":"#"},{"_active":true,"title":"6","image":'.$axtronic_home_2['axtronic-logo-partner-6'].',"link_brand":"#"}],"bg_color":""},"component":"RegularBlock","open":true,"is_container":false},{"type":"testimonial","name":"Testimonial","model":{"title":"Feedback from Customers","style":"style_2","list_testimonial":[{"_active":false,"title_item":"Jimmy Kimich","job":"Digital Marketer","content":" Ipsum dolor sit amet, consectetur adipiscing elit. Fringilla vel tincidunt ipsum ac. Nam at et id leo pulvinar egestas mi lorem. Adipiscing felis, vel faucibus in.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed..","number_star":5,"image":'.$axtronic_home_2['axtronic-testimonial-1'].'},{"_active":false,"title_item":"General First Aid","job":"Graphic Designer","content":" Ipsum dolor sit amet, consectetur adipiscing elit. Fringilla vel tincidunt ipsum ac. Nam at et id leo pulvinar egestas mi lorem. Adipiscing felis, vel faucibus in.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed..","number_star":5,"image":'.$axtronic_home_2['axtronic-testimonial-2'].'},{"_active":false,"title_item":"John Dee","job":"Graphic Designer","content":" Ipsum dolor sit amet, consectetur adipiscing elit. Fringilla vel tincidunt ipsum ac. Nam at et id leo pulvinar egestas mi lorem. Adipiscing felis, vel faucibus in.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed..","number_star":5,"image":'.$axtronic_home_2['axtronic-testimonial-3'].'}],"style_header":"style_3","bg_color":"","is_dark":true},"component":"RegularBlock","open":true,"is_container":false}]',
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );
        // Axtronic home page 2
        $axtronic_page2_id = DB::table('core_pages')->insertGetId([
            'title'       => 'Axtronic HomePage 2',
            'slug'        => 'axtronic-home-page-2',
            'template_id' => $axtronic_templlate_2_id,
            'show_template' => 1,
            'author_id' => 1,
            'create_user' => '1',
            'status'      => 'publish',
            'created_at'  => date("Y-m-d H:i:s")
        ]);

        DB::table('core_page_meta')->insert([[
            'parent_id'       => $axtronic_page2_id,
            'name'        => 'header_style',
            'val' => '2',
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ],[
            'parent_id'       => $axtronic_page2_id,
            'name'        => 'footer_style',
            'val' => '2',
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]]);

        //Axtronic home layout 3
        $axtronic_home_3 = [
            'axtronic-banner-slider-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-slider-1', 'file_path' => 'axtronic/mainslider-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-slider-1'])->id,
            'axtronic-banner-slider-2'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-slider-2', 'file_path' => 'axtronic/mainslider-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-slider-2'])->id,
            'axtronic-banner-slider-3'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-slider-3', 'file_path' => 'axtronic/mainslider-3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-slider-3'])->id,

            'axtronic-promotion-12'=> MediaFile::updateOrCreate(['file_name' => 'h3-banner1', 'file_path' => 'axtronic/promotion/h3-banner1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'h3-banner1'])->id,
            'axtronic-promotion-13'=> MediaFile::updateOrCreate(['file_name' => 'h3-banner2', 'file_path' => 'axtronic/promotion/h3-banner2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'h3-banner2'])->id,

            'axtronic-banner-bg-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-section-1', 'file_path' => 'axtronic/banner-section-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-section-1'])->id,
            'axtronic-bg-banner-2'=> MediaFile::updateOrCreate(['file_name' => 'aaxtronic-banner-bg-2', 'file_path' => 'axtronic/bg-banner-2.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-banner-bg-2'])->id,

            'axtronic-testimonial-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-testimonial-1', 'file_path' => 'axtronic/avarta1.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-testimonial-1'])->id,
            'axtronic-testimonial-2'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-testimonial-2', 'file_path' => 'axtronic/avarta2.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-testimonial-2'])->id,
            'axtronic-testimonial-3'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-testimonial-3', 'file_path' => 'axtronic/avarta3.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-testimonial-3'])->id,

            'axtronic-logo-partner-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-1', 'file_path' => 'axtronic/partner/partner-1.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-1'])->id,
            'axtronic-logo-partner-2'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-2', 'file_path' => 'axtronic/partner/partner-2.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-2'])->id,
            'axtronic-logo-partner-3'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-3', 'file_path' => 'axtronic/partner/partner-3.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-3'])->id,
            'axtronic-logo-partner-4'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-4', 'file_path' => 'axtronic/partner/partner-4.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-4'])->id,
            'axtronic-logo-partner-5'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-5', 'file_path' => 'axtronic/partner/partner-5.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-5'])->id,
            'axtronic-logo-partner-6'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-6', 'file_path' => 'axtronic/partner/partner-6.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-6'])->id,

        ];
        // Axtronic homepage 3 template
        $axtronic_templlate_3_id = DB::table('core_templates')->insertGetId(
            [
                'title' =>  'Axtronic HomePage 3',
                'content'   =>  '[{"type":"banner_slider_v2","name":"Banner Text Slider","model":{"width_slider":"container","sliders_banner":[{"_active":false,"title":"Best Camera Smartphone","sub_title":"On Sale","image":'.$axtronic_home_3['axtronic-banner-slider-1'].',"sub_text":"<span>original price $799.00</span><br>$550.99","btn_shop_now":"Shop Now","link_shop_now":"#"},{"_active":false,"title":"New arrivals Smartwatch","sub_title":"On Sale","image":'.$axtronic_home_3['axtronic-banner-slider-2'].',"sub_text":"<span>original price $799.00</span><br>$550.99","btn_shop_now":"Shop Now","link_shop_now":"#"},{"_active":false,"title":"New arrivals Smartwatch","sub_title":"Sound","image":'.$axtronic_home_3['axtronic-banner-slider-3'].',"sub_text":"<span>original price $799.00</span><br>$550.99","btn_shop_now":"Shop Now","link_shop_now":"#"}],"sliders_2":[{"_active":false,"sub_title":"Laptop, PC","title":"Office Laptop","content":"<span>Starting at</span><br>$699.00","link":"#","image":'.$axtronic_home_3['axtronic-promotion-12'].',"position":"top_left","style_color":"dark"},{"_active":false,"sub_title":"Sound","title":"Marshall Speaker","content":"<span>Starting at</span><br>$299.00","link":"#","image":'.$axtronic_home_3['axtronic-promotion-13'].',"position":"top_left","style_color":"dark"}],"is_category":true},"component":"RegularBlock","open":true,"is_container":false},{"type":"featured_icon","name":"Featured Icon","model":{"list_items":[{"_active":true,"title":"Free Shipping","sub_title":null,"icon":null},{"_active":true,"title":"Free Shipping","sub_title":"Free shipping on all order","icon":"axtronic-icon-group"},{"_active":true,"title":"Free Shipping","sub_title":"Free shipping on all order","icon":"axtronic-icon-medal-star"},{"_active":true,"title":"Free Shipping","sub_title":"Free shipping on all order","icon":"axtronic-icon-heart-circle"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"product_feature","name":"Feature Product ","model":{"style":"style_3","width_style":"container","title":"Deals Of The Week","is_dark":"","title_content":"","content":"","style_header":"style_2","order":"title","order_by":"asc","is_featured":true,"bg_content":"","bg_color":"#7075F1"},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_product","name":"Product: List item","model":{"style_list":"","style_header":"style_2","title":"Trending Cellphones","cat_ids":["9","12","18","19","20"],"number":4,"order":"id","order_by":"asc","is_featured":"","bg_content":"","is_dark":true},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_product","name":"Product: List item","model":{"style_list":"","style_header":"style_2","title":"Trending Laptops","cat_ids":["4","18","26","1"],"number":4,"order":"title","order_by":"asc","is_featured":"","bg_content":"","is_dark":true},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_product","name":"Product: List item","model":{"style_list":"","style_header":"style_2","title":"Trending Sound Devices","cat_ids":["1","28","27"],"number":4,"order":"id","order_by":"asc","is_featured":"","bg_content":"","is_dark":true},"component":"RegularBlock","open":true,"is_container":false},{"type":"banner_text","name":"Banner Text","model":{"style":"","banner_width":"container","content":"<div class=\"sub-title\">Smart performance</div>\n<h2 >GET $50 OFF YOUR NEXT ORDER</h2>","content2":"","image":"","bg_content":'.$axtronic_home_3['axtronic-bg-banner-2'].'},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_product","name":"Product: List item","model":{"style_list":"grid","style_header":"","title":"Best Selling Products","cat_ids":[],"number":6,"order":"id","order_by":"asc","is_featured":"","bg_content":"","is_dark":true},"component":"RegularBlock","open":true,"is_container":false},{"type":"testimonial","name":"Testimonial","model":{"title":"Feedback from Customers","style":"style_2","list_testimonial":[{"_active":false,"title_item":"Jimmy Kimich","job":"Digital Marketer","content":"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna lirabe. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.","number_star":5,"image":'.$axtronic_home_3['axtronic-testimonial-1'].'},{"_active":false,"title_item":"General First Aid","job":"Graphic Designer","content":"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna lirabe. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.","number_star":5,"image":'.$axtronic_home_3['axtronic-testimonial-2'].'},{"_active":false,"title_item":"Jimmy Kimich","job":"Digital Marketer","content":"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna lirabe. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.","number_star":5,"image":'.$axtronic_home_3['axtronic-testimonial-3'].'}],"style_header":"style_3","bg_color":"","is_dark":true},"component":"RegularBlock","open":true,"is_container":false},{"type":"brand_slider","name":"Brands","model":{"style":"style_2","brands":[{"_active":true,"title":"1","image":'.$axtronic_home_3['axtronic-logo-partner-1'].',"link_brand":null},{"_active":true,"title":"2","image":'.$axtronic_home_3['axtronic-logo-partner-2'].',"link_brand":null},{"_active":true,"title":"3","image":'.$axtronic_home_3['axtronic-logo-partner-3'].',"link_brand":"#"},{"_active":true,"title":"4","image":'.$axtronic_home_3['axtronic-logo-partner-4'].',"link_brand":"#"},{"_active":true,"title":"5","image":'.$axtronic_home_3['axtronic-logo-partner-5'].',"link_brand":"#"},{"_active":true,"title":"6","image":'.$axtronic_home_3['axtronic-logo-partner-6'].',"link_brand":"#"}],"bg_color":""},"component":"RegularBlock","open":true,"is_container":false}]',
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );
        // Axtronic home page 3
        $axtronic_page3_id = DB::table('core_pages')->insertGetId([
            'title'       => 'Axtronic Home Page 3',
            'slug'        => 'axtronic-home-page-3',
            'template_id' => $axtronic_templlate_3_id,
            'show_template' => 1,
            'author_id' => 1,
            'create_user' => '1',
            'status'      => 'publish',
            'created_at'  => date("Y-m-d H:i:s")
        ]);

        DB::table('core_page_meta')->insert([[
            'parent_id'       => $axtronic_page3_id,
            'name'        => 'header_style',
            'val' => '2',
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ],[
            'parent_id'       => $axtronic_page3_id,
            'name'        => 'footer_style',
            'val' => '2',
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]]);

        //Axtronic home layout 4
        $axtronic_home_4 = [
            'axtronic-banner-slider-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-slider-1', 'file_path' => 'axtronic/mainslider-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-slider-1'])->id,
            'axtronic-banner-slider-2'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-slider-2', 'file_path' => 'axtronic/mainslider-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-slider-2'])->id,
            'axtronic-banner-slider-3'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-slider-3', 'file_path' => 'axtronic/mainslider-3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-slider-3'])->id,

            'axtronic-promotion-12'=> MediaFile::updateOrCreate(['file_name' => 'h3-banner1', 'file_path' => 'axtronic/promotion/h3-banner1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'h3-banner1'])->id,
            'axtronic-promotion-13'=> MediaFile::updateOrCreate(['file_name' => 'h3-banner2', 'file_path' => 'axtronic/promotion/h3-banner2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'h3-banner2'])->id,

            'axtronic-banner-2'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-2', 'file_path' => 'axtronic/banner2.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-banner-2'])->id,
            'axtronic-banner-bg-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-section-1', 'file_path' => 'axtronic/banner-section-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-section-1'])->id,

            'axtronic-testimonial-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-testimonial-1', 'file_path' => 'axtronic/avarta1.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-testimonial-1'])->id,
            'axtronic-testimonial-2'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-testimonial-2', 'file_path' => 'axtronic/avarta2.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-testimonial-2'])->id,
            'axtronic-testimonial-3'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-testimonial-3', 'file_path' => 'axtronic/avarta3.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-testimonial-3'])->id,

            'axtronic-logo-partner-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-1', 'file_path' => 'axtronic/partner/partner-1.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-1'])->id,
            'axtronic-logo-partner-2'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-2', 'file_path' => 'axtronic/partner/partner-2.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-2'])->id,
            'axtronic-logo-partner-3'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-3', 'file_path' => 'axtronic/partner/partner-3.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-3'])->id,
            'axtronic-logo-partner-4'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-4', 'file_path' => 'axtronic/partner/partner-4.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-4'])->id,
            'axtronic-logo-partner-5'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-5', 'file_path' => 'axtronic/partner/partner-5.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-5'])->id,
            'axtronic-logo-partner-6'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-6', 'file_path' => 'axtronic/partner/partner-6.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-6'])->id,

        ];
        // Axtronic homepage 4 template
        $axtronic_templlate_4_id = DB::table('core_templates')->insertGetId(
            [
                'title' =>  'Axtronic HomePage 4',
                'content'   =>  '[{"type":"banner_slider","name":"Banner Slider","model":{"width_slider":"slider-fluid","sliders":[{"_active":false,"title":"New arrivals Smartphone","sub_title":"On Sale","image":'.$axtronic_home_4['axtronic-banner-slider-1'].',"sub_text":"<span>original price $799.00</span><br>$550.99","btn_shop_now":"Shop Now","link_shop_now":"#"},{"_active":false,"title":"Best Camera Smartphone","sub_title":"On Sale","image":'.$axtronic_home_4['axtronic-banner-slider-2'].',"sub_text":"<span>original price $799.00</span><br>$550.99","btn_shop_now":"Shop Now","link_shop_now":"#"},{"_active":false,"title":"New arrivals Smartphone","sub_title":"Sound","image":'.$axtronic_home_4['axtronic-banner-slider-3'].',"sub_text":"<span>original price $799.00</span><br>$550.99","btn_shop_now":"Shop Now","link_shop_now":"#"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"featured_icon_2","name":"Featured Icon 2","model":{"style":"style_2","image":'.$axtronic_home_4['axtronic-banner-2'].',"list_items":[{"_active":false,"title":"Free Shipping","sub_title":"Free shipping on all order","icon":"axtronic-icon-group"},{"_active":false,"title":"Free Shipping","sub_title":"Free shipping on all order","icon":"axtronic-icon-medal-star"},{"_active":false,"title":"Free Shipping","sub_title":"Free shipping on all order","icon":"axtronic-icon-wallet"},{"_active":false,"title":"Free Shipping","sub_title":"Free shipping on all order","icon":"axtronic-icon-heart-circle"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"gap","name":"Gaps","model":{"gap":"50"},"component":"RegularBlock","open":true},{"type":"product_tab","name":"Product Tab","model":{"style_list":"style_2","title":"Trending Sound Devices","is_dark":"","number":12,"is_latest":true,"is_featured":true,"is_rate":true,"order_by":"desc"},"component":"RegularBlock","open":true},{"type":"banner_text","name":"Banner Text","model":{"style":"","banner_width":"banner_fluid","content":"<div class=\"sub-title\">Smart performance</div>\n<h1 class=\"c-main\">Briliant visual</h1>\n<a href=\"#\" class=\"item-link\">Shop Now <i class=\"axtronic-icon-angle-right\"></i> </a>","content2":"","image":"","bg_content":'.$axtronic_home_4['axtronic-banner-bg-1'].'},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_product","name":"Product: List item","model":{"style_list":"grid","style_header":"style_3","title":"Daily Deals","cat_ids":"","number":12,"order":"","order_by":"","is_featured":"","bg_content":"","is_dark":""},"component":"RegularBlock","open":true,"is_container":false},{"type":"block_news","name":"Recent news","model":{"title":"Recent News","category_id":"","order":"","order_by":"","style_title":""},"component":"RegularBlock","open":true,"is_container":false},{"type":"testimonial","name":"Testimonial","model":{"title":"What Our Customer Say","style":"style_3","list_testimonial":[{"_active":false,"title_item":"Jimmy Kimich","job":"Digital Marketer","content":"Ipsum dolor sit amet, consectetur adipiscing elit. Fringilla vel tincidunt ipsum ac. Nam at et id leo pulvinar egestas mi lorem. Adipiscing felis, vel faucibus in.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed..","number_star":5,"image":'.$axtronic_home_4['axtronic-testimonial-1'].'},{"_active":false,"title_item":"Ultrasound Simulation","job":"Graphic Designer","content":"Ipsum dolor sit amet, consectetur adipiscing elit. Fringilla vel tincidunt ipsum ac. Nam at et id leo pulvinar egestas mi lorem. Adipiscing felis, vel faucibus in.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed..","number_star":5,"image":'.$axtronic_home_4['axtronic-testimonial-2'].'},{"_active":false,"title_item":"General First Aid","job":"Graphic Designer","content":"Ipsum dolor sit amet, consectetur adipiscing elit. Fringilla vel tincidunt ipsum ac. Nam at et id leo pulvinar egestas mi lorem. Adipiscing felis, vel faucibus in.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed..","number_star":5,"image":'.$axtronic_home_4['axtronic-testimonial-3'].'}],"bg_color":"#fff","is_dark":true,"style_header":"style_3"},"component":"RegularBlock","open":true,"is_container":false},{"type":"brand_slider","name":"Brands","model":{"style":"style_2","bg_color":"","brands":[{"_active":true,"title":"1","image":'.$axtronic_home_4['axtronic-logo-partner-1'].',"link_brand":"#"},{"_active":true,"title":"2","image":'.$axtronic_home_4['axtronic-logo-partner-2'].',"link_brand":null},{"_active":false,"title":"3","image":'.$axtronic_home_4['axtronic-logo-partner-3'].',"link_brand":null},{"_active":false,"title":"4","image":'.$axtronic_home_4['axtronic-logo-partner-4'].',"link_brand":null},{"_active":false,"title":"5","image":'.$axtronic_home_4['axtronic-logo-partner-5'].',"link_brand":null},{"_active":false,"title":"6","image":'.$axtronic_home_4['axtronic-logo-partner-6'].',"link_brand":null}]},"component":"RegularBlock","open":true,"is_container":false}]',
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );
        // Axtronic home page 4
        $axtronic_page4_id = DB::table('core_pages')->insertGetId([
            'title'       => 'Axtronic Home Page 4',
            'slug'        => 'axtronic-home-page-4',
            'template_id' => $axtronic_templlate_4_id,
            'show_template' => 1,
            'author_id' => 1,
            'create_user' => '1',
            'status'      => 'publish',
            'created_at'  => date("Y-m-d H:i:s")
        ]);

        DB::table('core_page_meta')->insert([[
            'parent_id'       => $axtronic_page4_id,
            'name'        => 'header_style',
            'val' => '2',
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ],[
            'parent_id'       => $axtronic_page4_id,
            'name'        => 'footer_style',
            'val' => '2',
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]]);


        //Axtronic home layout 5
        $axtronic_home_5 = [
            'axtronic-banner-slider-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-slider-1', 'file_path' => 'axtronic/mainslider-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-slider-1'])->id,
            'axtronic-banner-slider-2'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-slider-2', 'file_path' => 'axtronic/mainslider-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-slider-2'])->id,
            'axtronic-banner-slider-3'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-slider-3', 'file_path' => 'axtronic/mainslider-3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-slider-3'])->id,

            'axtronic-promotion-14'=> MediaFile::updateOrCreate(['file_name' => 'h3-banner1', 'file_path' => 'axtronic/promotion/h5-banner1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'h5-banner1'])->id,
            'axtronic-promotion-15'=> MediaFile::updateOrCreate(['file_name' => 'h3-banner2', 'file_path' => 'axtronic/promotion/h5-banner2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'h5-banner2'])->id,

            'axtronic-banner-2'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-2', 'file_path' => 'axtronic/banner2.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-banner-2'])->id,
            'axtronic-banner-bg-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-section-1', 'file_path' => 'axtronic/banner-section-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-section-1'])->id,

            'axtronic-testimonial-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-testimonial-1', 'file_path' => 'axtronic/avarta1.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-testimonial-1'])->id,
            'axtronic-testimonial-2'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-testimonial-2', 'file_path' => 'axtronic/avarta2.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-testimonial-2'])->id,
            'axtronic-testimonial-3'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-testimonial-3', 'file_path' => 'axtronic/avarta3.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-testimonial-3'])->id,

            'axtronic-logo-partner-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-1', 'file_path' => 'axtronic/partner/partner-1.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-1'])->id,
            'axtronic-logo-partner-2'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-2', 'file_path' => 'axtronic/partner/partner-2.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-2'])->id,
            'axtronic-logo-partner-3'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-3', 'file_path' => 'axtronic/partner/partner-3.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-3'])->id,
            'axtronic-logo-partner-4'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-4', 'file_path' => 'axtronic/partner/partner-4.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-4'])->id,
            'axtronic-logo-partner-5'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-5', 'file_path' => 'axtronic/partner/partner-5.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-5'])->id,
            'axtronic-logo-partner-6'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-6', 'file_path' => 'axtronic/partner/partner-6.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-6'])->id,

        ];
        // Axtronic homepage 5 template
        $axtronic_templlate_5_id = DB::table('core_templates')->insertGetId(
            [
                'title' =>  'Axtronic HomePage 5',
                'content'   =>  '[{"type":"banner_slider","name":"Banner Slider","model":{"width_slider":"slider-fluid","sliders":[{"_active":false,"title":"New arrivals Smartwatch","sub_title":"On Sale","image":'.$axtronic_home_5['axtronic-banner-slider-1'].',"sub_text":"<span>original price $799.00</span><br>$550.99","btn_shop_now":"Shop Now","link_shop_now":"#"},{"_active":true,"title":"Best Camera Smartphone","sub_title":"On Sale","image":'.$axtronic_home_5['axtronic-banner-slider-2'].',"sub_text":"<span>original price $799.00</span><br>$550.99","btn_shop_now":"Shop Now","link_shop_now":"#"},{"_active":false,"title":"Best Camera Smartphone","sub_title":"On Sale","image":'.$axtronic_home_5['axtronic-banner-slider-3'].',"sub_text":"<span>original price $799.00</span><br>$550.99","btn_shop_now":"Shop Now","link_shop_now":"#"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"gap","name":"Gaps","model":{"gap":"50"},"component":"RegularBlock","open":true},{"type":"banner_product","name":"Banner Width Product","model":{"title_header":"Popular Products","cat_ids":"","order":"id","order_by":"asc","title":"THE BEST<br> DEll XPS","sub_title":" Explore the best laptops at Axtronic. ","image":'.$axtronic_home_5['axtronic-promotion-14'].',"sub_text":"From<br><sup>$</sup><span>1,44</span><sup>999</sup>","btn_shop_now":"Shop Now","link_shop_now":"#","position":"right"},"component":"RegularBlock","open":true,"is_container":false},{"type":"banner_product","name":"Banner Width Product","model":{"title_header":"","cat_ids":"","order":"rate","order_by":"asc","title":"THE NEWEST<br> MARSHALL","sub_title":"Explore the best laptops at Axtronic. ","image":'.$axtronic_home_5['axtronic-promotion-15'].',"sub_text":"From<br><sup>$</sup><span>1,44</span><sup>999</sup>","btn_shop_now":"Shop Now","link_shop_now":"#","position":"left"},"component":"RegularBlock","open":true,"is_container":false},{"type":"featured_icon","name":"Featured Icon","model":{"list_items":[{"_active":true,"title":"Free Shipping","sub_title":"Free shipping on all order","icon":"axtronic-icon-group"},{"_active":false,"title":"Free Shipping","sub_title":"Free shipping on all order","icon":"axtronic-icon-medal-star"},{"_active":false,"title":"Free Shipping","sub_title":"Free shipping on all order","icon":"axtronic-icon-heart-circle"},{"_active":true,"title":"Free Shipping","sub_title":"Free shipping on all order","icon":"axtronic-icon-wallet"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"banner_text","name":"Banner Text","model":{"style":"","banner_width":"banner_fluid","content":"\n                <div class=\"sub-title\">Smart performance</div>\n<h1 class=\"c-main\">Briliant visual</h1>\n<a href=\"#\" class=\"item-link\">Shop Now <i class=\"axtronic-icon-angle-right\"></i> </a>\n","content2":"","image":"","bg_content":'.$axtronic_home_5['axtronic-banner-bg-1'].'},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_product","name":"Product: List item","model":{"style_list":"","style_header":"style_3","title":"Featured Products","cat_ids":"","number":12,"order":"id","order_by":"asc","is_featured":true,"bg_content":"","is_dark":true},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_product","name":"Product: List item","model":{"style_list":"slide","style_header":"","title":"Recently Viewed","cat_ids":"","number":12,"order":"title","order_by":"asc","is_featured":"","bg_content":"","is_dark":true},"component":"RegularBlock","open":true,"is_container":false},{"type":"banner_text","name":"Banner Text","model":{"style":"","banner_width":"container","content":"<div class=\"sub-title\">Smart performance</div>\n<h2>GET $50 OFF YOUR NEXT ORDER</h2>","content2":"","image":"","bg_content":'.$axtronic_home_5['axtronic-banner-2'].'},"component":"RegularBlock","open":true,"is_container":false},{"type":"block_news","name":"Recent news","model":{"title":"Recent News","category_id":"","order":"title","order_by":"asc","style_title":"text-center"},"component":"RegularBlock","open":true,"is_container":false},{"type":"brand_slider","name":"Brands","model":{"style":"style_2","brands":[{"_active":false,"title":"1","image":'.$axtronic_home_5['axtronic-logo-partner-1'].',"link_brand":"#"},{"_active":false,"title":"2","image":'.$axtronic_home_5['axtronic-logo-partner-2'].',"link_brand":"#"},{"_active":false,"title":"3","image":'.$axtronic_home_5['axtronic-logo-partner-3'].',"link_brand":"#"},{"_active":false,"title":"4","image":'.$axtronic_home_5['axtronic-logo-partner-4'].',"link_brand":"#"},{"_active":false,"title":"5","image":'.$axtronic_home_5['axtronic-logo-partner-5'].',"link_brand":"#"},{"_active":false,"title":"6","image":'.$axtronic_home_5['axtronic-logo-partner-6'].',"link_brand":"#"}],"bg_color":""},"component":"RegularBlock","open":true,"is_container":false}]',
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );
        // Axtronic home page 5
        $axtronic_page5_id = DB::table('core_pages')->insertGetId([
            'title'       => 'Axtronic Home Page 5',
            'slug'        => 'axtronic-home-page-5',
            'template_id' => $axtronic_templlate_5_id,
            'show_template' => 1,
            'author_id' => 1,
            'create_user' => '1',
            'status'      => 'publish',
            'created_at'  => date("Y-m-d H:i:s")
        ]);

        DB::table('core_page_meta')->insert([[
            'parent_id'       => $axtronic_page5_id,
            'name'        => 'header_style',
            'val' => '2',
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ],[
            'parent_id'       => $axtronic_page5_id,
            'name'        => 'footer_style',
            'val' => '2',
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]]);

        //Axtronic home layout 6
        $axtronic_home_6 = [
            'axtronic-banner-slider-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-slider-1', 'file_path' => 'axtronic/mainslider-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-slider-1'])->id,
            'axtronic-banner-slider-2'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-slider-2', 'file_path' => 'axtronic/mainslider-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-slider-2'])->id,
            'axtronic-banner-slider-3'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-slider-3', 'file_path' => 'axtronic/mainslider-3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-slider-3'])->id,

            'axtronic-banner-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-2', 'file_path' => 'axtronic/banner1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-1'])->id,

            'axtronic-testimonial-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-testimonial-1', 'file_path' => 'axtronic/avarta1.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-testimonial-1'])->id,
            'axtronic-testimonial-2'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-testimonial-2', 'file_path' => 'axtronic/avarta2.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-testimonial-2'])->id,
            'axtronic-testimonial-3'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-testimonial-3', 'file_path' => 'axtronic/avarta3.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-testimonial-3'])->id,

            'axtronic-logo-partner-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-1', 'file_path' => 'axtronic/partner/partner-1.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-1'])->id,
            'axtronic-logo-partner-2'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-2', 'file_path' => 'axtronic/partner/partner-2.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-2'])->id,
            'axtronic-logo-partner-3'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-3', 'file_path' => 'axtronic/partner/partner-3.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-3'])->id,
            'axtronic-logo-partner-4'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-4', 'file_path' => 'axtronic/partner/partner-4.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-4'])->id,
            'axtronic-logo-partner-5'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-5', 'file_path' => 'axtronic/partner/partner-5.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-5'])->id,
            'axtronic-logo-partner-6'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-6', 'file_path' => 'axtronic/partner/partner-6.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-6'])->id,

        ];
        // Axtronic homepage 6 template
        $axtronic_templlate_6_id = DB::table('core_templates')->insertGetId(
            [
                'title' =>  'Axtronic HomePage 6',
                'content'   =>  '[{"type":"gap","name":"Gaps","model":{"gap":"30"},"component":"RegularBlock","open":true},{"type":"banner_slider","name":"Banner Slider","model":{"width_slider":"container","sliders":[{"_active":false,"title":"New arrivals Smartphone","sub_title":"On Sale","image":'.$axtronic_home_6['axtronic-banner-slider-1'].',"sub_text":"<span>original price $799.00</span><br>$550.99","btn_shop_now":"Shop Now","link_shop_now":"#"},{"_active":false,"title":"Best Camera Smartphone","sub_title":"On Sale","image":'.$axtronic_home_6['axtronic-banner-slider-2'].',"sub_text":"<span>original price $799.00</span><br>$550.99","btn_shop_now":"Shop Now","link_shop_now":"#"},{"_active":true,"title":"Best Camera Smartphone","sub_title":"On Sale","image":'.$axtronic_home_6['axtronic-banner-slider-3'].',"sub_text":"<span>original price $799.00</span><br>$550.99","btn_shop_now":"Shop Now","link_shop_now":"#"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"category_product","name":"Category Product","model":{"title_name":"Category","style":"","list_items":[{"_active":true,"category_id":"12","icon":"axtronic-icon-group"},{"_active":true,"category_id":"28","icon":"axtronic-icon-airpods"},{"_active":true,"category_id":"16","icon":"axtronic-icon-watch"},{"_active":true,"category_id":"18","icon":"axtronic-icon-glass"},{"_active":true,"category_id":"24","icon":"axtronic-icon-gameboy"},{"_active":true,"category_id":"19","icon":"axtronic-icon-monitor-mobbile"},{"_active":true,"category_id":"20","icon":"axtronic-icon-tablet"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_product","name":"Product: List item","model":{"style_list":"","style_header":"","is_dark":true,"title":"Trending Products ","cat_ids":"","number":12,"order":"id","order_by":"asc","is_featured":"","bg_content":""},"component":"RegularBlock","open":true,"is_container":false},{"type":"product_feature","name":"Feature Product ","model":{"style":"style_2","title":"Deals Of The Week","is_dark":"","title_content":"","content":"","style_header":"","order":"id","order_by":"asc","is_featured":true,"bg_content":'.$axtronic_home_6['axtronic-banner-1'].',"bg_color":"","width_style":"container"},"component":"RegularBlock","open":true,"is_container":false},{"type":"testimonial","name":"Testimonial","model":{"title":"Feedback from Customers","style_header":"style_3","is_dark":true,"style":"style_3","bg_color":"#eff5f8","list_testimonial":[{"_active":false,"title_item":"Jimmy Kimich","job":"Digital Marketer","content":"Ipsum dolor sit amet, consectetur adipiscing elit. Fringilla vel tincidunt ipsum ac. Nam at et id leo pulvinar egestas mi lorem. Adipiscing felis, vel faucibus in.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed..","number_star":5,"image":'.$axtronic_home_6['axtronic-testimonial-1'].'},{"_active":false,"title_item":"General First Aid","job":"Digital Marketer","content":"Ipsum dolor sit amet, consectetur adipiscing elit. Fringilla vel tincidunt ipsum ac. Nam at et id leo pulvinar egestas mi lorem. Adipiscing felis, vel faucibus in.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed..","number_star":5,"image":'.$axtronic_home_6['axtronic-testimonial-3'].'},{"_active":false,"title_item":"Jimmy Kimich","job":"Digital Marketer","content":"Ipsum dolor sit amet, consectetur adipiscing elit. Fringilla vel tincidunt ipsum ac. Nam at et id leo pulvinar egestas mi lorem. Adipiscing felis, vel faucibus in.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed..","number_star":5,"image":'.$axtronic_home_6['axtronic-testimonial-2'].'}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"brand_slider","name":"Brands","model":{"style":"style_3","brands":[{"_active":false,"title":"1","image":'.$axtronic_home_6['axtronic-logo-partner-1'].',"link_brand":null},{"_active":false,"title":"2","image":'.$axtronic_home_6['axtronic-logo-partner-2'].',"link_brand":null},{"_active":true,"title":"3","image":'.$axtronic_home_6['axtronic-logo-partner-3'].',"link_brand":null},{"_active":true,"title":"4","image":'.$axtronic_home_6['axtronic-logo-partner-4'].',"link_brand":null},{"_active":true,"title":"5","image":'.$axtronic_home_6['axtronic-logo-partner-5'].',"link_brand":null},{"_active":true,"title":"6","image":'.$axtronic_home_6['axtronic-logo-partner-6'].',"link_brand":null}],"bg_color":"#fff"},"component":"RegularBlock","open":true,"is_container":false}]',
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );
        // Axtronic home page 6
        $axtronic_page6_id = DB::table('core_pages')->insertGetId([
            'title'       => 'Axtronic Home Page 6',
            'slug'        => 'axtronic-home-page-6',
            'template_id' => $axtronic_templlate_6_id,
            'show_template' => 1,
            'author_id' => 1,
            'create_user' => '1',
            'status'      => 'publish',
            'created_at'  => date("Y-m-d H:i:s")
        ]);

        DB::table('core_page_meta')->insert([[
            'parent_id'       => $axtronic_page6_id,
            'name'        => 'header_style',
            'val' => '2',
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ],[
            'parent_id'       => $axtronic_page6_id,
            'name'        => 'footer_style',
            'val' => '2',
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]]);

        //Axtronic home layout 7
        $axtronic_home_7 = [
            'axtronic-banner-slider-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-slider-1', 'file_path' => 'axtronic/mainslider-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-slider-1'])->id,
            'axtronic-banner-slider-2'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-slider-2', 'file_path' => 'axtronic/mainslider-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-slider-2'])->id,
            'axtronic-banner-slider-3'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-slider-3', 'file_path' => 'axtronic/mainslider-3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-slider-3'])->id,

            'axtronic-banner-bg-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-banner-section-1', 'file_path' => 'axtronic/banner-section-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-banner-section-1'])->id,

            'axtronic-promotion-16'=> MediaFile::updateOrCreate(['file_name' => 'h3-banner1', 'file_path' => 'axtronic/promotion/h7-banner1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'h7-banner1'])->id,
            'axtronic-promotion-17'=> MediaFile::updateOrCreate(['file_name' => 'h3-banner2', 'file_path' => 'axtronic/promotion/h7-banner2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'h7-banner2'])->id,
            'axtronic-promotion-18'=> MediaFile::updateOrCreate(['file_name' => 'h3-banner2', 'file_path' => 'axtronic/promotion/h7-banner3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'h7-banner3'])->id,

            'axtronic-logo-partner-1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-1', 'file_path' => 'axtronic/partner/partner-1.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-1'])->id,
            'axtronic-logo-partner-2'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-2', 'file_path' => 'axtronic/partner/partner-2.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-2'])->id,
            'axtronic-logo-partner-3'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-3', 'file_path' => 'axtronic/partner/partner-3.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-3'])->id,
            'axtronic-logo-partner-4'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-4', 'file_path' => 'axtronic/partner/partner-4.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-4'])->id,
            'axtronic-logo-partner-5'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-5', 'file_path' => 'axtronic/partner/partner-5.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-5'])->id,
            'axtronic-logo-partner-6'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-logo-partner-6', 'file_path' => 'axtronic/partner/partner-6.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'axtronic-logo-partner-6'])->id,

        ];
        // Axtronic homepage 7 template
        $axtronic_templlate_7_id = DB::table('core_templates')->insertGetId(
            [
                'title' =>  'Axtronic HomePage 7',
                'content'   =>  '[{"type":"banner_slider_v2","name":"Banner Text Slider","model":{"width_slider":"container","sliders_banner":[{"_active":false,"title":"New arrivals Smartphone","sub_title":"On Sale","image":'.$axtronic_home_7['axtronic-banner-slider-1'].',"sub_text":"<span>original price $799.00</span><br>$550.99","btn_shop_now":"Shop Now","link_shop_now":"#"},{"_active":false,"title":"Best Camera Smartphone","sub_title":"On Sale","image":'.$axtronic_home_7['axtronic-banner-slider-2'].',"sub_text":"<span>original price $799.00</span><br>$550.99","btn_shop_now":"Shop Now","link_shop_now":null},{"_active":false,"title":"Best Camera Smartphone","sub_title":"Sound","image":'.$axtronic_home_7['axtronic-banner-slider-3'].',"sub_text":"<span>original price $799.00</span><br>$550.99","btn_shop_now":"Shop Now","link_shop_now":null}],"sliders_2":[{"_active":false,"sub_title":"Sound","title":"Laptop Devices ","content":"<span>Start from</span><br>$699.00","link":"#","image":'.$axtronic_home_7['axtronic-promotion-16'].',"position":"bottom_left","style_color":"light"},{"_active":false,"sub_title":"On Sale","title":"Headphone","content":"<span>Starting at</span><br>$699.00","link":"#","image":'.$axtronic_home_7['axtronic-promotion-17'].',"position":"top_left","style_color":"light"},{"_active":false,"sub_title":"On Sale","title":"Headphone","content":"<span>Start from</span><br>$699.00","link":"#","image":'.$axtronic_home_7['axtronic-promotion-18'].',"position":"top_left","style_color":"light"}],"is_category":""},"component":"RegularBlock","open":true,"is_container":false},{"type":"product_feature","name":"Feature Product ","model":{"style":"","width_style":"container","title":"Special Offer Products","is_dark":true,"title_content":"Hot Offer","content":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,","style_header":"style_3","order":"id","order_by":"asc","is_featured":true,"bg_content":"","bg_color":""},"component":"RegularBlock","open":true,"is_container":false},{"type":"category_product","name":"Category Product","model":{"title_name":"Our Categories","style":"style_2","list_items":[{"_active":false,"category_id":"15","icon":null},{"_active":false,"category_id":"25","icon":null},{"_active":false,"category_id":"29","icon":null},{"_active":false,"category_id":"1","icon":null},{"_active":false,"category_id":"8","icon":null}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"gap","name":"Gaps","model":{"gap":"50"},"component":"RegularBlock","open":true},{"type":"list_product","name":"Product: List item","model":{"style_list":"","style_header":"style_3","is_dark":true,"title":"Featured Products","cat_ids":"","number":12,"order":"id","order_by":"asc","is_featured":true,"bg_content":""},"component":"RegularBlock","open":true,"is_container":false},{"type":"banner_text","name":"Banner Text","model":{"style":"","banner_width":"banner_fluid","content":"<h3 style=\"font-size: 60px; text-align: center\">Axtronic is the best <br> place to buy <br> electronic goods!</h3>","content2":"","image":"","bg_content":'.$axtronic_home_7['axtronic-banner-bg-1'].'},"component":"RegularBlock","open":true,"is_container":false},{"type":"block_news","name":"Recent news","model":{"title":"Recent News","style_title":"text-center","category_id":"","order":"id","order_by":"asc"},"component":"RegularBlock","open":true,"is_container":false},{"type":"brand_slider","name":"Brands","model":{"style":"style_2","bg_color":"","brands":[{"_active":true,"title":"1","image":'.$axtronic_home_7['axtronic-logo-partner-1'].',"link_brand":"#"},{"_active":true,"title":"2","image":'.$axtronic_home_7['axtronic-logo-partner-2'].',"link_brand":"#"},{"_active":true,"title":"3","image":'.$axtronic_home_7['axtronic-logo-partner-3'].',"link_brand":"#"},{"_active":true,"title":"4","image":'.$axtronic_home_7['axtronic-logo-partner-4'].',"link_brand":"#"},{"_active":true,"title":"5","image":'.$axtronic_home_7['axtronic-logo-partner-5'].',"link_brand":"#"},{"_active":true,"title":"6","image":'.$axtronic_home_7['axtronic-logo-partner-6'].',"link_brand":"#"}]},"component":"RegularBlock","open":true}]',
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );
        // Axtronic home page 7
        $axtronic_page7_id = DB::table('core_pages')->insertGetId([
            'title'       => 'Axtronic Home Page 7',
            'slug'        => 'axtronic-home-page-7',
            'template_id' => $axtronic_templlate_7_id,
            'show_template' => 1,
            'author_id' => 1,
            'create_user' => '1',
            'status'      => 'publish',
            'created_at'  => date("Y-m-d H:i:s")
        ]);

        DB::table('core_page_meta')->insert([[
            'parent_id'       => $axtronic_page7_id,
            'name'        => 'header_style',
            'val' => '2',
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ],[
            'parent_id'       => $axtronic_page7_id,
            'name'        => 'footer_style',
            'val' => '2',
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]]);


        //Axtronic contact
        $axtronic_contact_id = DB::table('core_templates')->insertGetId([
            'title'       => 'Axtronic Contact',
            'content'     => '[{"type":"contact_block","name":"Contact Block","model":{"class":"","title":"Let\'s get in touch","right_title":"Get in touch","sub_title":"We\'re open for any suggestion or just to have a chat","address":"198 West 21th Street, Suite 721 New York NY 10016","phone":"1234 5678 89","email":"contact@becommerce.test","website":"yoursite.com","sub_right_title":"Lorem, ipsum dolor sit amet consectetur adipisicing elit. Expedita quaerat unde quam dolor culpa veritatis inventore, aut commodi eum veniam vel.","iframe_map":"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d19868.32496225223!2d-0.119554!3d51.503297!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4291f3172409ea92!2zTeG6r3QgTHXDom4gxJDDtG4!5e0!3m2!1svi!2sus!4v1652327732823!5m2!1svi!2sus"},"component":"RegularBlock","open":true,"is_container":false}]',
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]);

        DB::table('core_pages')->insertGetId([
            'title'         => 'Axtronic Contact',
            'slug'          => 'axtronic-contact',
            'template_id'   => $axtronic_contact_id,
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
                'name'       => 'Support',
                'url'        => '/',
                'item_model' => 'custom',
                'model_name' => 'Custom',
                'layout'     => '',
                'bg'         => '',
                'children'   => array(),
            ),
            array(
                'name'       => 'Featured Products',
                'url'        => '/',
                'item_model' => 'custom',
                'model_name' => 'Custom',
                'layout'     => '',
                'bg'         => '',
                'children'   => array(),
            ),
            array(
                'name'       => 'FAQ',
                'url'        => '/',
                'item_model' => 'custom',
                'model_name' => 'Custom',
                'layout'     => '',
                'bg'         => '',
                'children'   => array(),
            ),

        );
    }
}
