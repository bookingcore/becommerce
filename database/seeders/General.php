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
<p>502 New Design Str, Melbourne, Australia <br><a href="mailto:contact@be-commerce.org">contact@be-commerce.org</a></p>
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
                        'name'  => 'home_page_id',
                        'val'   => "1",
                        'group' => "general",
                    ]
                ]
            );

            DB::table('core_pages')->insert([
                'title'       => 'Home Page',
                'slug'        => 'home-page',
                'template_id' => '2',
                'show_template' => 1,
                'author_id' => 1,
                'create_user' => '1',
                'status'      => 'publish',
                'created_at'  => date("Y-m-d H:i:s")
            ]);

            DB::table('core_pages')->insert([
                'title'       => 'Become a Vendor',
                'slug'        => 'become-a-vendor',
                'template_id' => '1',
                'show_template' => '1',
                'create_user' => '1',
                'author_id' => 1,
                'status'      => 'publish',
                'created_at'  => date("Y-m-d H:i:s")
            ]);

            DB::table('core_pages')->insert([
                'title'       => 'Contact',
                'slug'        => 'contact',
                'template_id' => '3',
                'show_template' => '1',
                'create_user' => '1',
                'author_id' => 1,
                'status'      => 'publish',
                'created_at'  => date("Y-m-d H:i:s")
            ]);

            // Setting Currency
            DB::table('core_settings')->insert([
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
                    'val'   => ",",
                    'group' => "payment",
                ],
                [
                    'name'  => "currency_thousand",
                    'val'   => ".",
                    'group' => "payment",
                ],
                [
                    'name'  => "currency_no_decimal",
                    'val'   => "0",
                    'group' => "payment",
                ],
                [
                    'name'  => "extra_currency",
                    'val'   => '[{"currency_main":"eur","currency_format":"left","currency_thousand":".","currency_decimal":",","currency_no_decimal":"2","rate":"0.902807"},{"currency_main":"jpy","currency_format":"right_space","currency_thousand":".","currency_decimal":",","currency_no_decimal":"0","rate":"0.00917113"}]',
                    'group' => "payment",
                ]
            ]);

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

            $primary_menu = [
                [
                    "id"            => 1,
                    "name"          => "Home Page",
                    "class"         => "",
                    "target"        => "",
                    "item_model"    => "Modules\Page\Models\Page",
                    "origin_name"   => "Home Page",
                    "model_name"    => "Page",
                    "_open"         => false,
                    "origin_edit_url"=> ""
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
                            "name" => "Shop",
                            "url" => "/product",
                            "item_model" => "custom",
                            "_open" => false,
                            "model_name" => "Custom",
                            "is_removed" => true
                        ],
                        [
                            "name" => "Category Layout",
                            "url" => "/category/clothing-apparel",
                            "item_model" => "custom",
                            "_open" => false,
                            "model_name" => "Custom",
                            "is_removed" => true
                        ],

                        [
                            "name" => "Product Detail",
                            "url" => "/product/mens-sports-runnning-swim-board-shorts",
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
                        ],
                        [
                            "name" => "Contact",
                            "url" => "/page/contact",
                            "item_model" => "custom",
                            "_open" => false
                        ]
                    ]
                ],
                [
                    "name" => "Blog",
                    "url" => "",
                    "item_model" => "custom",
                    "_open" => false,
                    "target" => "",
                    "children" => [
                        [
                            "name" => "Blog List",
                            "url" => "/news",
                            "item_model" => "custom",
                            "_open" => false
                        ],
                        [
                            "name" => "Blog Detail",
                            "url" => "/news/explore-fashion-trending-for-guys-in-autumn-2017",
                            "item_model" => "custom",
                            "_open" => false
                        ]
                    ]
                ]
            ];
            //Menu
            DB::table('core_menus')->insert(
                [
                    [
                        'name'  => "Main Menu",
                        'items' =>  json_encode($primary_menu),
                        'create_user'   =>  1,
                        'update_user'   =>  1
                    ]
                ]
            );
        }
}
