<?php
namespace Database\Seeders;
    use Illuminate\Support\Str;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;
    use Modules\Media\Models\MediaFile;

    class General extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            DB::table('core_settings')->insert(
                [
                    [
                        'name'  => 'menu_locations',
                        'val'   => '{"primary":1,"department":2,"menu_right":3,"menu_header_top":4}',
                        'group' => "general",
                    ],
                    [
                        'name'  => 'admin_email',
                        'val'   => 'contact@be-commerce.org',
                        'group' => "general",
                    ], [
                        'name'  => 'email_from_name',
                        'val'   => 'Becommerce',
                        'group' => "general",
                    ], [
                        'name'  => 'email_from_address',
                        'val'   => 'contact@be-commerce.org',
                        'group' => "general",
                    ],
                    [
                        'name'  => 'site_favicon',
                        'val'   => '',
                        'group' => "general",
                    ],

                    [
                        'name'  => 'topbar_left_text',
                        'val'   => '<div class="socials-list"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-linkedin"></i></a><a href="#"><i class="fa fa-google-plus"></i></a></div><a href="mailto:contact@bookingcore.com">contact@bookingcore.com</a>',
                        'group' => "general",
                    ],
                    [
                        'name'  => 'copyright',
                        'val'   => '© '.date('Y').' Becommerce. All Rights Reserved',
                        'group' => "general",
                    ],
                    [
                        'name'  => 'footer_info_text',
                        'val'   => '<h3 class="c-main fw-bold">1800 97 97 69</h3>
<p>502 New Design Str, Melbourne, Australia <br><a href="mailto:contact@martfury.co">contact@martfury.co</a></p>
<div class="socials-list">
    <a href="#"><i class="fa fa-facebook"></i></a>
    <a href="#"><i class="fa fa-linkedin"></i></a>
    <a href="#"><i class="fa fa-google-plus"></i></a>
</div>',
                        'group' => "general",
                    ],
                    [
                        'name'  => 'list_widget_footer',
                        'val'   => '{"1":{"title":"Quick links","size":"3","content":"<ul class=\"nav flex-column\">\r\n\t<li class=\"nav-item mb-2\"><a href=\"#\" class=\"nav-link p-0 text-muted\"> - Policy<\/a><\/li>\r\n\t<li class=\"nav-item mb-2\"><a href=\"#\" class=\"nav-link p-0 text-muted\"> - Term &amp; Condition<\/a><\/li>\r\n\t<li class=\"nav-item mb-2\"><a href=\"#\" class=\"nav-link p-0 text-muted\"> - Shipping<\/a><\/li>\r\n\t<li class=\"nav-item mb-2\"><a href=\"#\" class=\"nav-link p-0 text-muted\"> - Return<\/a><\/li>\r\n\t<li class=\"nav-item mb-2\"><a href=\"#\" class=\"nav-link p-0 text-muted\"> - FAQs<\/a><\/li>\r\n<\/ul>"},"2":{"title":"Company","size":"3","content":"<ul class=\"nav flex-column\">\r\n\t<li class=\"nav-item mb-2\"><a href=\"#\" class=\"nav-link p-0 text-muted\"> - About Us<\/a><\/li>\r\n\t<li class=\"nav-item mb-2\"><a href=\"#\" class=\"nav-link p-0 text-muted\"> - Affilate<\/a><\/li>\r\n\t<li class=\"nav-item mb-2\"><a href=\"#\" class=\"nav-link p-0 text-muted\"> - Career<\/a><\/li>\r\n\t<li class=\"nav-item mb-2\"><a href=\"#\" class=\"nav-link p-0 text-muted\"> - Contact<\/a><\/li>\r\n<\/ul>"},"3":{"title":"Bussiness","size":"3","content":"<ul class=\"nav flex-column\">\r\n\t<li class=\"nav-item mb-2\"><a href=\"#\" class=\"nav-link p-0 text-muted\"> - Our Press<\/a><\/li>\r\n\t<li class=\"nav-item mb-2\"><a href=\"#\" class=\"nav-link p-0 text-muted\"> - Checkout<\/a><\/li>\r\n\t<li class=\"nav-item mb-2\"><a href=\"#\" class=\"nav-link p-0 text-muted\"> - My account<\/a><\/li>\r\n\t<li class=\"nav-item mb-2\"><a href=\"#\" class=\"nav-link p-0 text-muted\"> - Shop<\/a><\/li>\r\n<\/ul>"}}',
                        'group' => "general",
                    ],
                    [
                        'name' => 'page_contact_title',
                        'val' => "We'd love to hear from you",
                        'group' => "general",
                    ],
                    [
                        'name' => 'page_contact_sub_title',
                        'val' => "Send us a message and we'll respond as soon as possible",
                        'group' => "general",
                    ],
                    [
                        'name' => 'page_contact_desc',
                        'val' => "<!DOCTYPE html><html><head></head><body><h3>Becommerce</h3><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>Tell. + 00 222 444 33</p><p>Email. hello@yoursite.org</p><p>1355 Market St, Suite 900San, Francisco, CA 94103 United States</p></body></html>",
                        'group' => "general",
                    ],
                    [
                        'name' => 'page_contact_image',
                        'val' => MediaFile::findMediaByName("bg_contact")->id,
                        'group' => "general",
                    ]
                ]
            );

            DB::table('core_pages')->insert([
                'title'       => 'Home Page',
                'slug'        => 'home-page',
                'template_id' => '2',
                'author_id' => 1,
                'create_user' => '1',
                'status'      => 'publish',
                'created_at'  => date("Y-m-d H:i:s")
            ]);

            DB::table('core_pages')->insert([
                'title'       => 'Become a Vendor',
                'slug'        => 'become-a-vendor',
                'template_id' => '1',
                'create_user' => '1',
                'author_id' => 1,
                'status'      => 'publish',
                'created_at'  => date("Y-m-d H:i:s")
            ]);



            // Setting Currency
            DB::table('core_settings')->insert(
                [
                    [
                        'name'  => "currency_main",
                        'val'   => "usd",
                        'group' => "payment",
                    ],
                    [
                        'name'  => "currency_format",
                        'val'   => "left",
                        'group' => "payment",
                    ],
                    [
                        'name'  => "currency_decimal",
                        'val'   => ".",
                        'group' => "payment",
                    ],
                    [
                        'name'  => "currency_thousand",
                        'val'   => ",",
                        'group' => "payment",
                    ],
                    [
                        'name'  => "currency_no_decimal",
                        'val'   => "2",
                        'group' => "payment",
                    ]
                ]
            );

            //MAP
            DB::table('core_settings')->insert(
                [
                    [
                        'name'  => 'map_provider',
                        'val'   => 'gmap',
                        'group' => "advance",
                    ],
                    [
                        'name'  => 'map_gmap_key',
                        'val'   => '',
                        'group' => "advance",
                    ]
                ]
            );

            // Payment Gateways
            DB::table('core_settings')->insert(
                [
                    [
                        'name'  => "g_offline_payment_enable",
                        'val'   => "1",
                        'group' => "payment",
                    ],
                    [
                        'name'  => "g_offline_payment_name",
                        'val'   => "Offline Payment",
                        'group' => "payment",
                    ]
                ]
            );

            // Settings general
            DB::table('core_settings')->insert(
                [
                    [
                        'name'  => "date_format",
                        'val'   => "m/d/Y",
                        'group' => "general",
                    ],
                    [
                        'name'  => "site_title",
                        'val'   => "Becommerce",
                        'group' => "general",
                    ],
                ]
            );

            // Email general
            DB::table('core_settings')->insert(
			[
                [
                    'name' => "site_timezone",
                    'val' => "UTC",
                    'group' => "general",
                ],
				[
					'name'  => "email_header",
					'val'   => '<h1 class="site-title" style="text-align: center">Becommerce</h1>',
					'group' => "general",
				],
				[
					'name'  => "email_footer",
					'val'   => '<p class="" style="text-align: center">&copy; 2019 Becommerce. All rights reserved</p>',
					'group' => "general",
				],
				[
					'name'  => "enable_mail_user_registered",
					'val'   => '',
					'group' => "user",
				],
				[
					'name'  => "user_content_email_registered",
					'val'   => '<h1 style="text-align: center">Welcome!</h1>
						<h3>Hello [first_name] [last_name]</h3>
						<p>Thank you for signing up with Becommerce! We hope you enjoy your time with us.</p>
						<p>Regards,</p>
						<p>Becommerce</p>',
					'group' => "user",
				],
				[
					'name'  => "admin_enable_mail_user_registered",
					'val'   => '',
					'group' => "user",
				],
				[
					'name'  => "admin_content_email_user_registered",
					'val'   => '<h3>Hello Administrator</h3>
						<p>We have new registration</p>
						<p>Full name: [first_name] [last_name]</p>
						<p>Email: [email]</p>
						<p>Regards,</p>
						<p>Becommerce</p>',
					'group' => "user",
				],
				[
					'name' => "user_content_email_forget_password",
					'val'  => '<h1>Hello!</h1>
						<p>You are receiving this email because we received a password reset request for your account.</p>
						<p style="text-align: center">[button_reset_password]</p>
						<p>This password reset link expire in 60 minutes.</p>
						<p>If you did not request a password reset, no further action is required.
						</p>
						<p>Regards,</p>
						<p>Becommerce</p>',
					'group' => "user",
				]
            ]
        );

            // Email Setting
            DB::table('core_settings')->insert(
                [
                    [
                        'name'  => "email_driver",
                        'val'   => "sendmail",
                        'group' => "email",
                    ],
                    [
                        'name'  => "email_host",
                        'val'   => "smtp.mailgun.org",
                        'group' => "email",
                    ],
                    [
                        'name'  => "email_port",
                        'val'   => "587",
                        'group' => "email",
                    ],
                    [
                        'name'  => "email_encryption",
                        'val'   => "tls",
                        'group' => "email",
                    ],
                    [
                        'name'  => "email_username",
                        'val'   => "",
                        'group' => "email",
                    ],
                    [
                        'name'  => "email_password",
                        'val'   => "",
                        'group' => "email",
                    ],
                    [
                        'name'  => "email_mailgun_domain",
                        'val'   => "",
                        'group' => "email",
                    ],
                    [
                        'name'  => "email_mailgun_secret",
                        'val'   => "",
                        'group' => "email",
                    ],
                    [
                        'name'  => "email_mailgun_endpoint",
                        'val'   => "api.mailgun.net",
                        'group' => "email",
                    ],
                    [
                        'name'  => "email_postmark_token",
                        'val'   => "",
                        'group' => "email",
                    ],
                    [
                        'name'  => "email_ses_key",
                        'val'   => "",
                        'group' => "email",
                    ],
                    [
                        'name'  => "email_ses_secret",
                        'val'   => "",
                        'group' => "email",
                    ],
                    [
                        'name'  => "email_ses_region",
                        'val'   => "us-east-1",
                        'group' => "email",
                    ],
                    [
                        'name'  => "email_sparkpost_secret",
                        'val'   => "",
                        'group' => "email",
                    ],
                ]
            );

            //Vendor setting
            DB::table('core_settings')->insert(
                [
                    [
                        'name'  => "vendor_enable",
                        'val'   => "1",
                        'group' => "vendor",
                    ],
                    [
                        'name'  => "vendor_commission_type",
                        'val'   => "percent",
                        'group' => "vendor",
                    ],
                    [
                        'name'  => "vendor_commission_amount",
                        'val'   => "10",
                        'group' => "vendor",
                    ],

                ]
            );


            $m_background = [
                'image-1'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'menu-1', 'file_path' => 'demo/templates/menu-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
                'image-2'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'menu-2', 'file_path' => 'demo/templates/menu-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            ];

            $primary_menu = [
                [
                    "id"                => 1,
                    "name"              => "Home",
                    "class"             => "",
                    "target"            => "",
                    "item_model"        => "Modules\Page\Models\Page",
                    "origin_name"       => "Home Page",
                    "model_name"        => "Page",
                    "_open"             => false,
                    "origin_edit_url"   => "/admin/module/page/edit/1",
                    "layout"            => "",
                    "children"          => [
                        [
                            "id"            => 1,
                            "name"          => "Marketplace Full Width",
                            "class"         => "",
                            "target"        => "",
                            "item_model"    => "Modules\Page\Models\Page",
                            "origin_name"   => "Home Page",
                            "model_name"    => "Page",
                            "_open"         => false,
                            "origin_edit_url"=> ""
                        ]
                    ]
                ],
                [
                    "name" =>"Shop",
                    "url"  =>"",
                    "item_model" => "custom",
                    "_open" => false,
                    "layout"=> "multi_row",
                    "model_name"=> "Custom",
                    "is_removed"=> true,
                    "children"  =>  [
                        [
                            "name" => "Catalog Pages",
                            "url" => "",
                            "item_model" => "custom",
                            "_open" => false,
                            "model_name" => "Custom",
                            "is_removed" => true,
                            "children" => [
                                [
                                    "name" => "Shop Sidebar",
                                    "url" => "/product",
                                    "item_model" => "custom",
                                    "_open" => false,
                                    "model_name" => "Custom",
                                    "is_removed" => true
                                ],
                                [
                                    "name" => "Category layout",
                                    "url" => "/category/clothing-apparel",
                                    "item_model" => "custom",
                                    "_open" => false,
                                    "model_name" => "Custom",
                                    "is_removed" => true
                                ],
                                [
                                    "name" => "Products Of Category",
                                    "url" => "/category/consumer-electrics",
                                    "item_model" => "custom",
                                    "_open" => false,
                                    "model_name" => "Custom",
                                    "is_removed" => true
                                ],
                            ]
                        ],
                        [
                            "name" => "Product Layouts",
                            "url" => "",
                            "item_model" => "custom",
                            "_open" => false,
                            "model_name" => "Custom",
                            "is_removed" => true,
                            "children" => [
                                [
                                    "name" => "Full Width",
                                    "url" => "/product/mens-sports-runnning-swim-board-shorts",
                                    "item_model" => "custom",
                                    "_open" => false,
                                    "model_name" => "Custom",
                                    "is_removed" => true
                                ]
                            ]
                        ],
                        [
                            "name" => "Product Types",
                            "url" => "",
                            "item_model" => "custom",
                            "_open" => false,
                            "model_name" => "Custom",
                            "is_removed" => true,
                            "children" => [
                                [
                                    "name" => "Simple",
                                    "url" => "/product/herschel-leather-duffle-bag-in-brown-color",
                                    "item_model" => "custom",
                                    "_open" => false,
                                    "model_name" => "Custom",
                                    "is_removed" => true
                                ],
                                [
                                    "name" => "Color Swatches",
                                    "url" => "/product/mens-sports-runnning-swim-board-shorts",
                                    "item_model" => "custom",
                                    "_open" => false,
                                    "model_name" => "Custom",
                                    "is_removed" => true
                                ],
                                [
                                    "name" => "Out of stock",
                                    "url" => "/product/korea-long-sofa-fabric-in-blue-navy-color",
                                    "item_model" => "custom",
                                    "_open" => false,
                                    "model_name" => "Custom",
                                    "is_removed" => true
                                ]
                            ]
                        ],
                        [
                            "name" => "Becommerce Pages",
                            "url" => "",
                            "item_model" => "custom",
                            "_open" => false,
                            "model_name" => "Custom",
                            "is_removed" => true,
                            "children" => [
                                [
                                    "name" => "Shopping Cart",
                                    "url" => "/booking/cart",
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
                                    "url" => "/login",
                                    "item_model" => "custom",
                                    "_open" => false
                                ]
                            ]
                        ],
                    ]
                ],
                [
                    "name" => "Pages",
                    "url" => "",
                    "item_model" => "custom",
                    "_open" => false,
                    "layout" => "multi_row",
                    "target" => "",
                    "children" => [
                        [
                            "name" => "Basic Pages",
                            "url" => "",
                            "item_model" => "",
                            "_open" => false,
                            "children" => [
                                [
                                    "name" => "404 Page",
                                    "url" => "/404",
                                    "item_model" => "custom",
                                    "_open" => false
                                ]
                            ]
                        ],
                        [
                            "name" => "Vendor Pages",
                            "url" => "",
                            "item_model" => "",
                            "_open" => false,
                            "children" => [
                                [
                                    "name" => "Become a Vendor",
                                    "url" => "/page/become-a-vendor",
                                    "item_model" => "custom",
                                    "_open" => false
                                ],
                                [
                                    "name" => "Vendor store",
                                    "url" => "/profile/1",
                                    "item_model" => "custom",
                                    "_open" => false
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "name" => "Blog",
                    "url" => "",
                    "item_model" => "custom",
                    "_open" => false,
                    "layout" => "multi_row",
                    "target" => "",
                    "children" => [
                        [
                            "name" => "Blog Layout",
                            "url" => "",
                            "item_model" => "custom",
                            "_open" => false,
                            "children" => [
                                [
                                    "name" => "Right Sidebar",
                                    "url" => "/news",
                                    "item_model" => "custom",
                                    "_open" => false
                                ]
                            ]
                        ],
                        [
                            "name" => "Single Blog",
                            "url" => "",
                            "item_model" => "custom",
                            "_open" => false,
                            "children" => [
                                [
                                    "name" => "Single",
                                    "url" => "/news/explore-fashion-trending-for-guys-in-autumn-2017",
                                    "item_model" => "custom",
                                    "_open" => false
                                ]
                            ]
                        ]
                    ]
                ]
            ];
            $department_menu = [
                [
                    'name'          =>  'Hot Promotions',
                    'url'           =>  '#',
                    'item_model'    =>  'custom',
                    '_open'         =>  false,
                    'icon'          =>  'icon-star',
                    'model_name'    =>  'Custom',
                    'is_removed'    =>  true
                ],
                [
                    'name'          =>  'Consumer Electrics',
                    'url'           =>  '#',
                    'item_model'    =>  'custom',
                    '_open'         =>  false,
                    'icon'          =>  'icon-laundry',
                    'layout'        =>  'multi_row',
                    'bg'            =>  $m_background['image-1'],
                    'model_name'    =>  'Custom',
                    'is_removed'    =>  true,
                    'children'      =>  [
                        [
                            'name'      =>  'Electronics',
                            'url'       =>  '#',
                            'item_model'=>  'custom',
                            '_open'     =>  false,
                            'layout'    =>  '',
                            'model_name'=>  'Custom',
                            'is_removed'=>  true,
                            'children'  =>  [
                                [
                                    'name'      =>  'Home Audios & Theaters',
                                    'url'       =>  '#',
                                    'item_model'=>  'custom',
                                    '_open'     =>  false,
                                    "model_name"=> 'Custom',
                                    'is_removed'=>  true,
                                ],
                                [
                                    'name'      =>  'TV & Videos',
                                    'url'       =>  '#',
                                    'item_model'=>  'custom',
                                    '_open'     =>  false,
                                    "model_name"=> 'Custom',
                                    'is_removed'=>  true,
                                ],
                                [
                                    'name'      =>  'Camera, Photos & Videos',
                                    'url'       =>  '#',
                                    'item_model'=>  'custom',
                                    '_open'     =>  false,
                                    "model_name"=> 'Custom',
                                    'is_removed'=>  true,
                                ],
                                [
                                    'name'      =>  'Cellphones & Accessories',
                                    'url'       =>  '#',
                                    'item_model'=>  'custom',
                                    '_open'     =>  false,
                                    "model_name"=> 'Custom',
                                    'is_removed'=>  true,
                                ],
                                [
                                    'name'      =>  'Headphones',
                                    'url'       =>  '#',
                                    'item_model'=>  'custom',
                                    '_open'     =>  false,
                                    "model_name"=> 'Custom',
                                    'is_removed'=>  true,
                                ],
                                [
                                    'name'      =>  'Videogames',
                                    'url'       =>  '#',
                                    'item_model'=>  'custom',
                                    '_open'     =>  false,
                                    "model_name"=> 'Custom',
                                    'is_removed'=>  true,
                                ],
                                [
                                    'name'      =>  'Wireless Speakers',
                                    'url'       =>  '#',
                                    'item_model'=>  'custom',
                                    '_open'     =>  false,
                                    "model_name"=> 'Custom',
                                    'is_removed'=>  true,
                                ],
                                [
                                    'name'      =>  'Office Electronics',
                                    'url'       =>  '#',
                                    'item_model'=>  'custom',
                                    '_open'     =>  false,
                                    "model_name"=> 'Custom',
                                    'is_removed'=>  true,
                                ]
                            ]
                        ],
                        [
                            'name'      =>  'Accessories & Parts',
                            'url'       =>  '#',
                            'item_model'=>  'custom',
                            '_open'     =>  false,
                            'layout'    =>  '',
                            'model_name'=>  'Custom',
                            'is_removed'=>  true,
                            'children'  =>  [
                                [
                                    'name'      =>  'Digital Cables',
                                    'url'       =>  '#',
                                    'item_model'=>  'custom',
                                    '_open'     =>  false,
                                    "model_name"=> 'Custom',
                                    'is_removed'=>  true,
                                ],
                                [
                                    'name'      =>  'Audio & Video Cables',
                                    'url'       =>  '#',
                                    'item_model'=>  'custom',
                                    '_open'     =>  false,
                                    "model_name"=> 'Custom',
                                    'is_removed'=>  true,
                                ],
                                [
                                    'name'      =>  'Batteries',
                                    'url'       =>  '#',
                                    'item_model'=>  'custom',
                                    '_open'     =>  false,
                                    "model_name"=> 'Custom',
                                    'is_removed'=>  true,
                                ],
                                [
                                    'name'      =>  'Charger',
                                    'url'       =>  '#',
                                    'item_model'=>  'custom',
                                    '_open'     =>  false,
                                    "model_name"=> 'Custom',
                                    'is_removed'=>  true,
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    'name'          =>  'Home, Garden & Kitchen',
                    'url'           =>  '#',
                    'item_model'    =>  'custom',
                    '_open'         =>  false,
                    'icon'          =>  'icon-lampshade',
                    'model_name'    =>  'Custom',
                    'is_removed'    =>  true
                ],
                [
                    'name'          =>  'Health & Beauty',
                    'url'           =>  '#',
                    'item_model'    =>  'custom',
                    '_open'         =>  false,
                    'icon'          =>  'icon-heart-pulse',
                    'model_name'    =>  'Custom',
                    'is_removed'    =>  true
                ],
                [
                    'name'          =>  'Jewelry & Watches',
                    'url'           =>  '#',
                    'item_model'    =>  'custom',
                    '_open'         =>  false,
                    'icon'          =>  'icon-diamond2',
                    'model_name'    =>  'Custom',
                    'is_removed'    =>  true
                ],
                [
                    'name'          =>  'Computers & Technologies',
                    'url'           =>  '#',
                    'item_model'    =>  'custom',
                    '_open'         =>  false,
                    'icon'          =>  'icon-desktop',
                    'model_name'    =>  'Custom',
                    'is_removed'    =>  true,
                    'layout'        =>  'multi_row',
                    'bg'            =>  $m_background['image-2'],
                    'children'      =>  [
                        [
                            'name'      =>  'Computer & Technologies',
                            'url'       =>  '#',
                            'item_model'=>  'custom',
                            '_open'     =>  false,
                            'icon'      =>  '',
                            'model_name'=>  'Custom',
                            'is_removed'=>  true,
                            'children'  =>  [
                                [
                                    'name'      =>  'Computers & Tablets',
                                    'url'       =>  '#',
                                    'item_model'=>  'custom',
                                    '_open'     =>  false,
                                    "model_name"=> 'Custom',
                                    'is_removed'=>  true,
                                ],
                                [
                                    'name'      =>  'Laptop',
                                    'url'       =>  '#',
                                    'item_model'=>  'custom',
                                    '_open'     =>  false,
                                    "model_name"=> 'Custom',
                                    'is_removed'=>  true,
                                ],
                                [
                                    'name'      =>  'Monitors',
                                    'url'       =>  '#',
                                    'item_model'=>  'custom',
                                    '_open'     =>  false,
                                    "model_name"=> 'Custom',
                                    'is_removed'=>  true,
                                ],
                                [
                                    'name'      =>  'Networking',
                                    'url'       =>  '#',
                                    'item_model'=>  'custom',
                                    '_open'     =>  false,
                                    "model_name"=> 'Custom',
                                    'is_removed'=>  true,
                                ],
                                [
                                    'name'      =>  'Drive & Storages',
                                    'url'       =>  '#',
                                    'item_model'=>  'custom',
                                    '_open'     =>  false,
                                    "model_name"=> 'Custom',
                                    'is_removed'=>  true,
                                ],
                                [
                                    'name'      =>  'Computer Components',
                                    'url'       =>  '#',
                                    'item_model'=>  'custom',
                                    '_open'     =>  false,
                                    "model_name"=> 'Custom',
                                    'is_removed'=>  true,
                                ],
                                [
                                    'name'      =>  'Security & Protection',
                                    'url'       =>  '#',
                                    'item_model'=>  'custom',
                                    '_open'     =>  false,
                                    "model_name"=> 'Custom',
                                    'is_removed'=>  true,
                                ],
                                [
                                    'name'      =>  'Gaming Laptop',
                                    'url'       =>  '#',
                                    'item_model'=>  'custom',
                                    '_open'     =>  false,
                                    "model_name"=> 'Custom',
                                    'is_removed'=>  true,
                                ],
                                [
                                    'name'      =>  'Accesories',
                                    'url'       =>  '#',
                                    'item_model'=>  'custom',
                                    '_open'     =>  false,
                                    "model_name"=> 'Custom',
                                    'is_removed'=>  true,
                                ],
                            ]
                        ]
                    ]
                ],
                [
                    'name'          =>  'Babies & Moms',
                    'url'           =>  '#',
                    'item_model'    =>  'custom',
                    '_open'         =>  false,
                    'icon'          =>  'icon-baby-bottle',
                    'model_name'    =>  'Custom',
                    'is_removed'    =>  true
                ],
                [
                    'name'          =>  'Sport & Outdoor',
                    'url'           =>  '#',
                    'item_model'    =>  'custom',
                    '_open'         =>  false,
                    'icon'          =>  'icon-baseball',
                    'model_name'    =>  'Custom',
                    'is_removed'    =>  true
                ],
                [
                    'name'          =>  'Phones & Accessories',
                    'url'           =>  '#',
                    'item_model'    =>  'custom',
                    '_open'         =>  false,
                    'icon'          =>  'icon-smartphone',
                    'model_name'    =>  'Custom',
                    'is_removed'    =>  true
                ],
                [
                    'name'          =>  'Books & Office',
                    'url'           =>  '#',
                    'item_model'    =>  'custom',
                    '_open'         =>  false,
                    'icon'          =>  'icon-book2',
                    'model_name'    =>  'Custom',
                    'is_removed'    =>  true
                ],
                [
                    'name'          =>  'Cars & Motocycles',
                    'url'           =>  '#',
                    'item_model'    =>  'custom',
                    '_open'         =>  false,
                    'icon'          =>  'icon-car-siren',
                    'model_name'    =>  'Custom',
                    'is_removed'    =>  true
                ],
                [
                    'name'          =>  'Home Improments',
                    'url'           =>  '#',
                    'item_model'    =>  'custom',
                    '_open'         =>  false,
                    'icon'          =>  'icon-wrench',
                    'model_name'    =>  'Custom',
                    'is_removed'    =>  true
                ],
                [
                    'name'          =>  'Vouchers & Services',
                    'url'           =>  '#',
                    'item_model'    =>  'custom',
                    '_open'         =>  false,
                    'icon'          =>  'icon-tag',
                    'model_name'    =>  'Custom',
                    'is_removed'    =>  true
                ],
            ];
            $right_menu = [
                [
                    "id" => 2,
                    "name" => "Sell On Becommerce",
                    "class" => "",
                    "target" => "",
                    "open" => false,
                    "item_model" => "Modules\Page\Models\Page",
                    "origin_name" => "Pages",
                    "model_name" => "Page",
                    "_open" => true
                ],
                [
                    "name" => 'Track Your Order',
                    "url" => '/user/orders',
                    "item_model" => 'custom',
                    "_open" => true
                ]
            ];

            //Menu
            DB::table('core_menus')->insert(
                [
                    [
                        'name'  => "Menu",
                        'items' =>  json_encode($primary_menu),
                        'create_user'   =>  1,
                        'update_user'   =>  1
                    ],
                    [
                        'name'  => "department menu",
                        'items' =>  json_encode($department_menu),
                        'create_user'   =>  1,
                        'update_user'   =>  1
                    ],
                    [
                        'name'  => "Right menu",
                        'items' =>  json_encode($right_menu),
                        'create_user'   =>  1,
                        'update_user'   =>  1
                    ],
                ]
            );
        }
}
