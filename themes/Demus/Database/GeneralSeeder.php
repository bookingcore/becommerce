<?php
namespace Themes\Demus\Database;
use App\User;
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
                    ]
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
                        "name" => "Icon",
                        "url" => "/page/axtronic-icon",
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
                'name'  => "Demus Menu",
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

        $logo_dark = MediaFile::updateOrCreate(['file_name' => 'demus-logo', 'file_path' => 'demus/logo.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'demus-logo-dark']);
        $favicon = MediaFile::updateOrCreate(['file_name' => 'demus-favicon', 'file_path' => 'demus/favicon.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'demus-favicon']);
        $logo_footer = MediaFile::updateOrCreate(['file_name' => 'demus-logo-footer', 'file_path' => 'demus/logo.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'demus-logo']);
        $bg_product = MediaFile::updateOrCreate(['file_name' => 'demus-bg-breadcrumb', 'file_path' => 'demus/image_bg.png', 'file_type' => 'image/png', 'file_extension' => 'png'],['file_name' => 'demus-logo']);
        setting_update_items(
            [
                [
                    'name'  => 'site_favicon',
                    'val'   => $favicon->id,
                ],
                [
                    'name'  => 'demus_logo_dark',
                    'val'   => $logo_dark->id,
                ],
                [
                    'name'  => 'demus_header_style',
                    'val'   => 'style_2',
                ],
                [
                    'name'  => 'demus_footer_style',
                    'val'   => 'style_2',
                ],
                [
                    'name'  => 'demus_footer_bg_color',
                    'val'   => '#fff',
                ],
                [
                    'name'  => 'demus_logo_footer',
                    'val'   => $logo_footer->id,
                ],
                [
                    'name'  => 'demus_footer_text_subscribe',
                    'val'   => 'Subscribe To Our Newsletter',
                ],
                [
                    'name'  => 'demus_list_widget_footer',
                    'val'   => '[{"title":"Quick Links","size":"4","content":"<ul class=\"list-items\">\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">Home<\/span>\r\n<\/a>\r\n<\/li>\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">Products<\/span>\r\n<\/a>\r\n<\/li>\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">Brands<\/span>\r\n<\/a>\r\n<\/li>\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">Hot Deal<\/span>\r\n<\/a>\r\n<\/li>\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">Blog<\/span>\r\n<\/a>\r\n<\/li>\r\n<\/ul>"},{"title":"My Account","size":"4","content":"<ul class=\"list-items\">\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">My Profile<\/span>\r\n<\/a>\r\n<\/li>\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">My Order History<\/span>\r\n<\/a>\r\n<\/li>\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">My Wishlist<\/span>\r\n<\/a>\r\n<\/li>\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">Order Tracking<\/span>\r\n<\/a>\r\n<\/li>\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">Shopping Cart<\/span>\r\n<\/a>\r\n<\/li>\r\n<\/ul>"},{"title":"Company","size":"4","content":"<ul class=\"list-items\">\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">About Us<\/span>\r\n<\/a>\r\n<\/li>\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">Careers<\/span>\r\n<\/a>\r\n<\/li>\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">Blog<\/span>\r\n<\/a>\r\n<\/li>\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">Affiliate<\/span>\r\n<\/a>\r\n<\/li>\r\n<li class=\"list-item\">\r\n<a href=\"#\">\r\n<span class=\"list-text\">Contact Us<\/span>\r\n<\/a>\r\n<\/li>\r\n<\/ul>"}]',
                ],
                [
                    'name'  => 'demus_footer_info_text',
                    'val'   => '<div class="footer-info--address">
		<i class="icons me-3 d-none">
			<svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M1152 640q0-106-75-181t-181-75-181 75-75 181 75 181 181 75 181-75 75-181zm256 0q0 109-33 179l-364 774q-16 33-47.5 52t-67.5 19-67.5-19-46.5-52l-365-774q-33-70-33-179 0-212 150-362t362-150 362 150 150 362z"></path></svg>
		</i>
		Call us: 888.312.2456 - 666.010.1238
	</div>
	<div class="footer-info--phone">
		<i class="icons me-3 d-none">
			<svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M1600 1240q0 27-10 70.5t-21 68.5q-21 50-122 106-94 51-186 51-27 0-53-3.5t-57.5-12.5-47-14.5-55.5-20.5-49-18q-98-35-175-83-127-79-264-216t-216-264q-48-77-83-175-3-9-18-49t-20.5-55.5-14.5-47-12.5-57.5-3.5-53q0-92 51-186 56-101 106-122 25-11 68.5-21t70.5-10q14 0 21 3 18 6 53 76 11 19 30 54t35 63.5 31 53.5q3 4 17.5 25t21.5 35.5 7 28.5q0 20-28.5 50t-62 55-62 53-28.5 46q0 9 5 22.5t8.5 20.5 14 24 11.5 19q76 137 174 235t235 174q2 1 19 11.5t24 14 20.5 8.5 22.5 5q18 0 46-28.5t53-62 55-62 50-28.5q14 0 28.5 7t35.5 21.5 25 17.5q25 15 53.5 31t63.5 35 54 30q70 35 76 53 3 7 3 21z"></path></svg>
		</i>
		Text: 200.490.1520 - 666.010.1238
	</div>
	<div class="footer-info--email">
		<i class="icons me-3 d-none">
			<svg width="14px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M464 64H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V112c0-26.51-21.49-48-48-48zm0 48v40.805c-22.422 18.259-58.168 46.651-134.587 106.49-16.841 13.247-50.201 45.072-73.413 44.701-23.208.375-56.579-31.459-73.413-44.701C106.18 199.465 70.425 171.067 48 152.805V112h416zM48 400V214.398c22.914 18.251 55.409 43.862 104.938 82.646 21.857 17.205 60.134 55.186 103.062 54.955 42.717.231 80.509-37.199 103.053-54.947 49.528-38.783 82.032-64.401 104.947-82.653V400H48z"></path></svg>
		</i>
		Email: demus@domain.vn
	</div>',
                ],
                [
                    'name'  => 'demus_footer_text_right',
                    'val'   => '<p><img src="/uploads/demus/general/payment-getway.png" /></p>',
                ],
                [
                    'name'  => 'demus_copyright',
                    'val'   => 'Copyright © Velatheme. All Right Reserved.',
                ],
                [
                    'name'  => 'demus_enable_scroll',
                    'val'   => true,
                ],
                [
                    'name'  => 'demus_enable_header_scroll',
                    'val'   => true,
                ],
                [
                    'name'  => 'demus_social_facebook',
                    'val'   => '#',
                ],
                [
                    'name'  => 'demus_social_twitter',
                    'val'   => '#',
                ],
                [
                    'name'  => 'demus_social_instagram',
                    'val'   => '#',
                ],
                [
                    'name'  => 'demus_social_linkedin',
                    'val'   => '#',
                ],
                [
                    'name'  => 'demus_social_pinterest',
                    'val'   => '#',
                ],
                [
                    'name'  => 'product_image',
                    'val'   => $bg_product->id,
                ],
                [
                    'name'  => 'product_page_search_title',
                    'val'   => 'Product',
                ],
                [
                    'name'  => 'news_page_list_title',
                    'val'   => 'News',
                ],
            ]
        );



        //Demus contact
        $demus_contact_id = DB::table('core_templates')->insertGetId([
            'title'       => 'Demus Contact',
            'content'     => '[{"type":"contact_block","name":"Contact Block","model":{"class":"","title":"Let\'s get in touch","right_title":"Get in touch","sub_title":"We\'re open for any suggestion or just to have a chat","address":"198 West 21th Street, Suite 721 New York NY 10016","phone":"1234 5678 89","email":"contact@becommerce.test","website":"yoursite.com","sub_right_title":"Lorem, ipsum dolor sit amet consectetur adipisicing elit. Expedita quaerat unde quam dolor culpa veritatis inventore, aut commodi eum veniam vel.","iframe_map":"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d19868.32496225223!2d-0.119554!3d51.503297!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4291f3172409ea92!2zTeG6r3QgTHXDom4gxJDDtG4!5e0!3m2!1svi!2sus!4v1652327732823!5m2!1svi!2sus"},"component":"RegularBlock","open":true,"is_container":false}]',
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]);

        DB::table('core_pages')->insertGetId([
            'title'         => 'Demus Contact',
            'slug'          => 'demus-contact',
            'template_id'   => $demus_contact_id,
            'show_template' => 1,
            'author_id'     => 1,
            'create_user'   => '1',
            'status'        => 'publish',
            'created_at'    => date("Y-m-d H:i:s")
        ]);

        //Demus icon
        DB::table('core_pages')->insertGetId([
            'title'         => 'Demus Icon',
            'slug'          => 'demus-icon',
            'template_id'   => '',
            'show_template' => 1,
            'author_id'     => 1,
            'create_user'   => '1',
            'status'        => 'publish',
            'created_at'    => date("Y-m-d H:i:s"),
            'content'       => '<div class="axtronic-icons-list"><div class="glyph"><div class="axtronic-icon-airpods"></div><div class="class-name">.axtronic-icon-airpods</div></div><div class="glyph"><div class="axtronic-icon-angle-down"></div><div class="class-name">.axtronic-icon-angle-down</div></div><div class="glyph"><div class="axtronic-icon-angle-left"></div><div class="class-name">.axtronic-icon-angle-left</div></div><div class="glyph"><div class="axtronic-icon-angle-right"></div><div class="class-name">.axtronic-icon-angle-right</div></div><div class="glyph"><div class="axtronic-icon-angle-up"></div><div class="class-name">.axtronic-icon-angle-up</div></div><div class="glyph"><div class="axtronic-icon-arrow-circle-down"></div><div class="class-name">.axtronic-icon-arrow-circle-down</div></div><div class="glyph"><div class="axtronic-icon-arrow-circle-left"></div><div class="class-name">.axtronic-icon-arrow-circle-left</div></div><div class="glyph"><div class="axtronic-icon-arrow-circle-right"></div><div class="class-name">.axtronic-icon-arrow-circle-right</div></div><div class="glyph"><div class="axtronic-icon-arrow-circle-up"></div><div class="class-name">.axtronic-icon-arrow-circle-up</div></div><div class="glyph"><div class="axtronic-icon-arrow-down"></div><div class="class-name">.axtronic-icon-arrow-down</div></div><div class="glyph"><div class="axtronic-icon-arrow-left"></div><div class="class-name">.axtronic-icon-arrow-left</div></div><div class="glyph"><div class="axtronic-icon-arrow-right"></div><div class="class-name">.axtronic-icon-arrow-right</div></div><div class="glyph"><div class="axtronic-icon-arrow-up"></div><div class="class-name">.axtronic-icon-arrow-up</div></div><div class="glyph"><div class="axtronic-icon-box"></div><div class="class-name">.axtronic-icon-box</div></div><div class="glyph"><div class="axtronic-icon-buliding"></div><div class="class-name">.axtronic-icon-buliding</div></div><div class="glyph"><div class="axtronic-icon-call-calling"></div><div class="class-name">.axtronic-icon-call-calling</div></div><div class="glyph"><div class="axtronic-icon-call-calling2"></div><div class="class-name">.axtronic-icon-call-calling2</div></div><div class="glyph"><div class="axtronic-icon-circle-phone"></div><div class="class-name">.axtronic-icon-circle-phone</div></div><div class="glyph"><div class="axtronic-icon-code"></div><div class="class-name">.axtronic-icon-code</div></div><div class="glyph"><div class="axtronic-icon-color-swatch"></div><div class="class-name">.axtronic-icon-color-swatch</div></div><div class="glyph"><div class="axtronic-icon-colorfilter"></div><div class="class-name">.axtronic-icon-colorfilter</div></div><div class="glyph"><div class="axtronic-icon-command"></div><div class="class-name">.axtronic-icon-command</div></div><div class="glyph"><div class="axtronic-icon-discount-shape"></div><div class="class-name">.axtronic-icon-discount-shape</div></div><div class="glyph"><div class="axtronic-icon-document-text"></div><div class="class-name">.axtronic-icon-document-text</div></div><div class="glyph"><div class="axtronic-icon-electricity"></div><div class="class-name">.axtronic-icon-electricity</div></div><div class="glyph"><div class="axtronic-icon-eye"></div><div class="class-name">.axtronic-icon-eye</div></div><div class="glyph"><div class="axtronic-icon-flash-circle"></div><div class="class-name">.axtronic-icon-flash-circle</div></div><div class="glyph"><div class="axtronic-icon-gameboy"></div><div class="class-name">.axtronic-icon-gameboy</div></div><div class="glyph"><div class="axtronic-icon-glass"></div><div class="class-name">.axtronic-icon-glass</div></div><div class="glyph"><div class="axtronic-icon-grid"></div><div class="class-name">.axtronic-icon-grid</div></div><div class="glyph"><div class="axtronic-icon-group"></div><div class="class-name">.axtronic-icon-group</div></div><div class="glyph"><div class="axtronic-icon-heart-circle"></div><div class="class-name">.axtronic-icon-heart-circle</div></div><div class="glyph"><div class="axtronic-icon-heart"></div><div class="class-name">.axtronic-icon-heart</div></div><div class="glyph"><div class="axtronic-icon-house-2"></div><div class="class-name">.axtronic-icon-house-2</div></div><div class="glyph"><div class="axtronic-icon-list"></div><div class="class-name">.axtronic-icon-list</div></div><div class="glyph"><div class="axtronic-icon-medal-star"></div><div class="class-name">.axtronic-icon-medal-star</div></div><div class="glyph"><div class="axtronic-icon-menu-right-1"></div><div class="class-name">.axtronic-icon-menu-right-1</div></div><div class="glyph"><div class="axtronic-icon-minus-square"></div><div class="class-name">.axtronic-icon-minus-square</div></div><div class="glyph"><div class="axtronic-icon-mobile"></div><div class="class-name">.axtronic-icon-mobile</div></div><div class="glyph"><div class="axtronic-icon-monitor-mobbile"></div><div class="class-name">.axtronic-icon-monitor-mobbile</div></div><div class="glyph"><div class="axtronic-icon-monitor"></div><div class="class-name">.axtronic-icon-monitor</div></div><div class="glyph"><div class="axtronic-icon-mouse-circle"></div><div class="class-name">.axtronic-icon-mouse-circle</div></div><div class="glyph"><div class="axtronic-icon-plus-square"></div><div class="class-name">.axtronic-icon-plus-square</div></div><div class="glyph"><div class="axtronic-icon-repeat-circle"></div><div class="class-name">.axtronic-icon-repeat-circle</div></div><div class="glyph"><div class="axtronic-icon-search"></div><div class="class-name">.axtronic-icon-search</div></div><div class="glyph"><div class="axtronic-icon-shop"></div><div class="class-name">.axtronic-icon-shop</div></div><div class="glyph"><div class="axtronic-icon-shopping-cart"></div><div class="class-name">.axtronic-icon-shopping-cart</div></div><div class="glyph"><div class="axtronic-icon-sms"></div><div class="class-name">.axtronic-icon-sms</div></div><div class="glyph"><div class="axtronic-icon-square-check"></div><div class="class-name">.axtronic-icon-square-check</div></div><div class="glyph"><div class="axtronic-icon-star-sharp"></div><div class="class-name">.axtronic-icon-star-sharp</div></div><div class="glyph"><div class="axtronic-icon-tablet"></div><div class="class-name">.axtronic-icon-tablet</div></div><div class="glyph"><div class="axtronic-icon-text-block"></div><div class="class-name">.axtronic-icon-text-block</div></div><div class="glyph"><div class="axtronic-icon-trash"></div><div class="class-name">.axtronic-icon-trash</div></div><div class="glyph"><div class="axtronic-icon-user"></div><div class="class-name">.axtronic-icon-user</div></div><div class="glyph"><div class="axtronic-icon-wallet"></div><div class="class-name">.axtronic-icon-wallet</div></div><div class="glyph"><div class="axtronic-icon-watch"></div><div class="class-name">.axtronic-icon-watch</div></div><div class="glyph"><div class="axtronic-icon-360"></div><div class="class-name">.axtronic-icon-360</div></div><div class="glyph"><div class="axtronic-icon-bars"></div><div class="class-name">.axtronic-icon-bars</div></div><div class="glyph"><div class="axtronic-icon-calendar"></div><div class="class-name">.axtronic-icon-calendar</div></div><div class="glyph"><div class="axtronic-icon-cart-empty"></div><div class="class-name">.axtronic-icon-cart-empty</div></div><div class="glyph"><div class="axtronic-icon-check"></div><div class="class-name">.axtronic-icon-check</div></div><div class="glyph"><div class="axtronic-icon-cloud-download-alt"></div><div class="class-name">.axtronic-icon-cloud-download-alt</div></div><div class="glyph"><div class="axtronic-icon-comment"></div><div class="class-name">.axtronic-icon-comment</div></div><div class="glyph"><div class="axtronic-icon-comments"></div><div class="class-name">.axtronic-icon-comments</div></div><div class="glyph"><div class="axtronic-icon-credit-card"></div><div class="class-name">.axtronic-icon-credit-card</div></div><div class="glyph"><div class="axtronic-icon-edit"></div><div class="class-name">.axtronic-icon-edit</div></div><div class="glyph"><div class="axtronic-icon-envelope"></div><div class="class-name">.axtronic-icon-envelope</div></div><div class="glyph"><div class="axtronic-icon-expand-alt"></div><div class="class-name">.axtronic-icon-expand-alt</div></div><div class="glyph"><div class="axtronic-icon-external-link-alt"></div><div class="class-name">.axtronic-icon-external-link-alt</div></div><div class="glyph"><div class="axtronic-icon-facebook"></div><div class="class-name">.axtronic-icon-facebook</div></div><div class="glyph"><div class="axtronic-icon-file-alt"></div><div class="class-name">.axtronic-icon-file-alt</div></div><div class="glyph"><div class="axtronic-icon-file-archive"></div><div class="class-name">.axtronic-icon-file-archive</div></div><div class="glyph"><div class="axtronic-icon-folder-open"></div><div class="class-name">.axtronic-icon-folder-open</div></div><div class="glyph"><div class="axtronic-icon-folder"></div><div class="class-name">.axtronic-icon-folder</div></div><div class="glyph"><div class="axtronic-icon-frown"></div><div class="class-name">.axtronic-icon-frown</div></div><div class="glyph"><div class="axtronic-icon-gift"></div><div class="class-name">.axtronic-icon-gift</div></div><div class="glyph"><div class="axtronic-icon-google-plus"></div><div class="class-name">.axtronic-icon-google-plus</div></div><div class="glyph"><div class="axtronic-icon-history"></div><div class="class-name">.axtronic-icon-history</div></div><div class="glyph"><div class="axtronic-icon-home"></div><div class="class-name">.axtronic-icon-home</div></div><div class="glyph"><div class="axtronic-icon-info-circle"></div><div class="class-name">.axtronic-icon-info-circle</div></div><div class="glyph"><div class="axtronic-icon-instagram"></div><div class="class-name">.axtronic-icon-instagram</div></div><div class="glyph"><div class="axtronic-icon-linkedin"></div><div class="class-name">.axtronic-icon-linkedin</div></div><div class="glyph"><div class="axtronic-icon-map-marker-check"></div><div class="class-name">.axtronic-icon-map-marker-check</div></div><div class="glyph"><div class="axtronic-icon-meh"></div><div class="class-name">.axtronic-icon-meh</div></div><div class="glyph"><div class="axtronic-icon-minus"></div><div class="class-name">.axtronic-icon-minus</div></div><div class="glyph"><div class="axtronic-icon-money-bill"></div><div class="class-name">.axtronic-icon-money-bill</div></div><div class="glyph"><div class="axtronic-icon-moon"></div><div class="class-name">.axtronic-icon-moon</div></div><div class="glyph"><div class="axtronic-icon-pencil-alt"></div><div class="class-name">.axtronic-icon-pencil-alt</div></div><div class="glyph"><div class="axtronic-icon-pinterest-p"></div><div class="class-name">.axtronic-icon-pinterest-p</div></div><div class="glyph"><div class="axtronic-icon-plus"></div><div class="class-name">.axtronic-icon-plus</div></div><div class="glyph"><div class="axtronic-icon-quote"></div><div class="class-name">.axtronic-icon-quote</div></div><div class="glyph"><div class="axtronic-icon-random"></div><div class="class-name">.axtronic-icon-random</div></div><div class="glyph"><div class="axtronic-icon-reply-all"></div><div class="class-name">.axtronic-icon-reply-all</div></div><div class="glyph"><div class="axtronic-icon-reply"></div><div class="class-name">.axtronic-icon-reply</div></div><div class="glyph"><div class="axtronic-icon-router"></div><div class="class-name">.axtronic-icon-router</div></div><div class="glyph"><div class="axtronic-icon-sign-out-alt"></div><div class="class-name">.axtronic-icon-sign-out-alt</div></div><div class="glyph"><div class="axtronic-icon-smile"></div><div class="class-name">.axtronic-icon-smile</div></div><div class="glyph"><div class="axtronic-icon-spinner"></div><div class="class-name">.axtronic-icon-spinner</div></div><div class="glyph"><div class="axtronic-icon-square"></div><div class="class-name">.axtronic-icon-square</div></div><div class="glyph"><div class="axtronic-icon-star"></div><div class="class-name">.axtronic-icon-star</div></div><div class="glyph"><div class="axtronic-icon-store"></div><div class="class-name">.axtronic-icon-store</div></div><div class="glyph"><div class="axtronic-icon-sun"></div><div class="class-name">.axtronic-icon-sun</div></div><div class="glyph"><div class="axtronic-icon-sync"></div><div class="class-name">.axtronic-icon-sync</div></div><div class="glyph"><div class="axtronic-icon-tachometer-alt"></div><div class="class-name">.axtronic-icon-tachometer-alt</div></div><div class="glyph"><div class="axtronic-icon-tag"></div><div class="class-name">.axtronic-icon-tag</div></div><div class="glyph"><div class="axtronic-icon-thumbtack"></div><div class="class-name">.axtronic-icon-thumbtack</div></div><div class="glyph"><div class="axtronic-icon-times-circle"></div><div class="class-name">.axtronic-icon-times-circle</div></div><div class="glyph"><div class="axtronic-icon-times"></div><div class="class-name">.axtronic-icon-times</div></div><div class="glyph"><div class="axtronic-icon-truck"></div><div class="class-name">.axtronic-icon-truck</div></div><div class="glyph"><div class="axtronic-icon-twitter"></div><div class="class-name">.axtronic-icon-twitter</div></div><div class="glyph"><div class="axtronic-icon-video"></div><div class="class-name">.axtronic-icon-video</div></div></div>'
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
