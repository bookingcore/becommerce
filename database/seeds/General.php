<?php

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
                        'val'   => '{"primary":1}',
                        'group' => "general",
                    ],
                    [
                        'name'  => 'admin_email',
                        'val'   => 'contact@bookingcore.com',
                        'group' => "general",
                    ], [
                        'name'  => 'email_from_name',
                        'val'   => 'BeCommerce',
                        'group' => "general",
                    ], [
                        'name'  => 'email_from_address',
                        'val'   => 'contact@bookingcore.com',
                        'group' => "general",
                    ],
                    [
                        'name'  => 'logo_id',
                        'val'   => MediaFile::findMediaByName("logo")->id ?? '',
                        'group' => "general",
                    ],
                    [
                        'name'  => 'site_favicon',
                        'val'   => MediaFile::findMediaByName("favicon")->id ?? '',
                        'group' => "general",
                    ],
                    [
                        'name'  => 'topbar_left_text',
                        'val'   => '<div class="socials">
    <a href="#"><i class="fa fa-facebook"></i></a>
    <a href="#"><i class="fa fa-linkedin"></i></a>
    <a href="#"><i class="fa fa-google-plus"></i></a>
</div>
<span class="line"></span>
<a href="mailto:contact@bookingcore.com">contact@bookingcore.com</a>',
                        'group' => "general",
                    ],
                    [
                        'name'  => 'footer_text_left',
                        'val'   => 'Copyright © 2019 by BeCommerce',
                        'group' => "general",
                    ],
                    [
                        'name'  => 'footer_text_right',
                        'val'   => 'BeCommerce',
                        'group' => "general",
                    ],
                    [
                        'name'  => 'list_widget_footer',
                        'val'   => '[{"title":"NEED HELP?","size":"3","content":"<div class=\"contact\">\r\n        <div class=\"c-title\">\r\n            Call Us\r\n        <\/div>\r\n        <div class=\"sub\">\r\n            + 00 222 44 5678\r\n        <\/div>\r\n    <\/div>\r\n    <div class=\"contact\">\r\n        <div class=\"c-title\">\r\n            Email for Us\r\n        <\/div>\r\n        <div class=\"sub\">\r\n            hello@yoursite.com\r\n        <\/div>\r\n    <\/div>\r\n    <div class=\"contact\">\r\n        <div class=\"c-title\">\r\n            Follow Us\r\n        <\/div>\r\n        <div class=\"sub\">\r\n            <a href=\"#\">\r\n                <i class=\"icofont-facebook\"><\/i>\r\n            <\/a>\r\n            <a href=\"#\">\r\n               <i class=\"icofont-twitter\"><\/i>\r\n            <\/a>\r\n            <a href=\"#\">\r\n                <i class=\"icofont-youtube-play\"><\/i>\r\n            <\/a>\r\n        <\/div>\r\n    <\/div>"},{"title":"COMPANY","size":"3","content":"<ul>\r\n    <li><a href=\"#\">About Us<\/a><\/li>\r\n    <li><a href=\"#\">Community Blog<\/a><\/li>\r\n    <li><a href=\"#\">Rewards<\/a><\/li>\r\n    <li><a href=\"#\">Work with Us<\/a><\/li>\r\n    <li><a href=\"#\">Meet the Team<\/a><\/li>\r\n<\/ul>"},{"title":"SUPPORT","size":"3","content":"<ul>\r\n    <li><a href=\"#\">Account<\/a><\/li>\r\n    <li><a href=\"#\">Legal<\/a><\/li>\r\n    <li><a href=\"#\">Contact<\/a><\/li>\r\n    <li><a href=\"#\">Affiliate Program<\/a><\/li>\r\n    <li><a href=\"#\">Privacy Policy<\/a><\/li>\r\n<\/ul>"},{"title":"SETTINGS","size":"3","content":"<ul>\r\n<li><a href=\"#\">Setting 1<\/a><\/li>\r\n<li><a href=\"#\">Setting 2<\/a><\/li>\r\n<\/ul>"}]',
                        'group' => "general",
                    ],
                    [
                        'name'  => 'list_widget_footer_ja',
                        'val'   => '[{"title":"\u52a9\u3051\u304c\u5fc5\u8981\uff1f","size":"3","content":"<div class=\"contact\">\r\n        <div class=\"c-title\">\r\n            \u304a\u96fb\u8a71\u304f\u3060\u3055\u3044\r\n        <\/div>\r\n        <div class=\"sub\">\r\n            + 00 222 44 5678\r\n        <\/div>\r\n    <\/div>\r\n    <div class=\"contact\">\r\n        <div class=\"c-title\">\r\n            \u90f5\u4fbf\u7269\r\n        <\/div>\r\n        <div class=\"sub\">\r\n            hello@yoursite.com\r\n        <\/div>\r\n    <\/div>\r\n    <div class=\"contact\">\r\n        <div class=\"c-title\">\r\n            \u30d5\u30a9\u30ed\u30fc\u3059\u308b\r\n        <\/div>\r\n        <div class=\"sub\">\r\n            <a href=\"#\">\r\n                <i class=\"icofont-facebook\"><\/i>\r\n            <\/a>\r\n            <a href=\"#\">\r\n                <i class=\"icofont-twitter\"><\/i>\r\n            <\/a>\r\n            <a href=\"#\">\r\n                <i class=\"icofont-youtube-play\"><\/i>\r\n            <\/a>\r\n        <\/div>\r\n    <\/div>"},{"title":"\u4f1a\u793e","size":"3","content":"<ul>\r\n    <li><a href=\"#\">\u7d04, \u7565<\/a><\/li>\r\n    <li><a href=\"#\">\u30b3\u30df\u30e5\u30cb\u30c6\u30a3\u30d6\u30ed\u30b0<\/a><\/li>\r\n    <li><a href=\"#\">\u5831\u916c<\/a><\/li>\r\n    <li><a href=\"#\">\u3068\u9023\u643a<\/a><\/li>\r\n    <li><a href=\"#\">\u30c1\u30fc\u30e0\u306b\u4f1a\u3046<\/a><\/li>\r\n<\/ul>"},{"title":"\u30b5\u30dd\u30fc\u30c8","size":"3","content":"<ul>\r\n    <li><a href=\"#\">\u30a2\u30ab\u30a6\u30f3\u30c8<\/a><\/li>\r\n    <li><a href=\"#\">\u6cd5\u7684<\/a><\/li>\r\n    <li><a href=\"#\">\u63a5\u89e6<\/a><\/li>\r\n    <li><a href=\"#\">\u30a2\u30d5\u30a3\u30ea\u30a8\u30a4\u30c8\u30d7\u30ed\u30b0\u30e9\u30e0<\/a><\/li>\r\n    <li><a href=\"#\">\u500b\u4eba\u60c5\u5831\u4fdd\u8b77\u65b9\u91dd<\/a><\/li>\r\n<\/ul>"},{"title":"\u8a2d\u5b9a","size":"3","content":"<ul>\r\n<li><a href=\"#\">\u8a2d\u5b9a1<\/a><\/li>\r\n<li><a href=\"#\">\u8a2d\u5b9a2<\/a><\/li>\r\n<\/ul>"}]',
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
                        'val' => "<!DOCTYPE html><html><head></head><body><h3>BeCommerce</h3><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>Tell. + 00 222 444 33</p><p>Email. hello@yoursite.com</p><p>1355 Market St, Suite 900San, Francisco, CA 94103 United States</p></body></html>",
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
                'create_user' => '1',
                'status'      => 'publish',
                'created_at'  => date("Y-m-d H:i:s")
            ]);

            DB::table('core_settings')->insert(
                [
                    [
                        'name'  => 'home_page_id',
                        'val'   => '1',
                        'group' => "general",
                    ],
                    [
                        'name' => 'page_contact_title',
                        'val' => "We'd love to hear from you",
                        'group' => "general",
                    ],
                    [
                        'name' => 'page_contact_title_ja',
                        'val' => "あなたからの御一報をお待ち",
                        'group' => "general",
                    ],
                    [
                        'name' => 'page_contact_sub_title',
                        'val' => "Send us a message and we'll respond as soon as possible",
                        'group' => "general",
                    ],
                    [
                        'name' => 'page_contact_sub_title_ja',
                        'val' => "私たちにメッセージを送ってください、私たちはできるだ",
                        'group' => "general",
                    ],
                    [
                        'name' => 'page_contact_desc',
                        'val' => "<!DOCTYPE html><html><head></head><body><h3>BeCommerce</h3><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>Tell. + 00 222 444 33</p><p>Email. hello@yoursite.com</p><p>1355 Market St, Suite 900San, Francisco, CA 94103 United States</p></body></html>",
                        'group' => "general",
                    ],
                    [
                        'name' => 'page_contact_image',
                        'val' => MediaFile::findMediaByName("bg_contact")->id ?? '',
                        'group' => "general",
                    ]
                ]
            );


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
                        'val'   => "BeCommerce",
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
                    'name' => "site_title",
                    'val' => "BeCommerce",
                    'group' => "general",
				],
				[
					'name'  => "email_header",
					'val'   => '<h1 class="site-title" style="text-align: center">BeCommerce</h1>',
					'group' => "general",
				],
				[
					'name'  => "email_footer",
					'val'   => '<p class="" style="text-align: center">&copy; 2019 BeCommerce. All rights reserved</p>',
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
						<p>Thank you for signing up with BeCommerce! We hope you enjoy your time with us.</p>
						<p>Regards,</p>
						<p>BeCommerce</p>',
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
						<p>BeCommerce</p>',
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
						<p>BeCommerce</p>',
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
                    [
                        'name'  => "vendor_role",
                        'val'   => "1",
                        'group' => "vendor",
                    ],

                ]
            );
            $items = [
                [
                    "id"=>1,
                    "name"=>"Home",
                    "class"=>"",
                    "target"=>"",
                    "open"=>false,
                    "item_model"=>"Modules\Page\Models\Page",
                    "origin_name"=>"Pages",
                    "model_name"=>"Page",
                    "_open"=>true
                ]
            ];
            //Menu
            DB::table('core_menus')->insert(
                [
                    [
                        'name'  => "Menu",
//                        'items'   => '[{"id":1,"name":"Home","class":"","target":"","item_model":"Modules\\Page\\Models\\Page","origin_name":"Home Page","model_name":"Page","_open":false,"layout":"multi_row","origin_edit_url":"http://becommere.dv/admin/module/page/edit/1","children":[]},{"name":"Shop","url":"/en/product","item_model":"custom","_open":false,"model_name":"Custom","is_removed":true},{"name":"Pages","url":"","item_model":"custom","_open":false,"model_name":"Custom","is_removed":true,"layout":"","children":[{"id":3,"name":"Become a Vendor","class":"","target":"","item_model":"Modules\\Page\\Models\\Page","origin_name":"Become a Vendor","model_name":"Page","_open":false,"origin_edit_url":"http://becommere.dv/admin/module/page/edit/3"}]},{"name":"News","url":"/en/news","item_model":"custom","_open":false,"model_name":"Custom","is_removed":true}]',
//                        'items'   => '[{"id":1,"name":"Home","class":"","target":"","open":false,"item_model":"Modules\Page\Models\Page","origin_name":"Pages","model_name":"Page","_open":true}]',
                        'items' =>  json_encode($items),
                        'create_user'   =>  1,
                        'update_user'   =>  1
                    ],
                ]
            );
            DB::table('core_menu_translations')->insert(
                [
                    [
                        'origin_id'=>1,
                        'locale'=>'ja',
                        'items' => json_encode($items),
                        'create_user'   =>  1,
                        'update_user'   =>  1
                    ],
                ]
            );
            DB::table('core_settings')->insert(
                [
                    [
                        'name'=>'footer_categories',
                        'group'=>'general',
                        'val' =>'<div class="widget widget_nav_menu">
    <h4 class="widget-title">Consumer Electric:</h4>
    <div class="menu-footer">
        <ul id="menu-footer-link" class="menu">
            <li><a href="#">Air Conditioners</a></li>
            <li><a href="#">Audios &amp; Theaters</a></li>
            <li><a href="#">Car Electronics</a></li>
            <li><a href="#">Office Electronics</a></li>
            <li><a href="#">TV Televisions</a></li>
            <li><a href="#">Washing Machines</a></li>
        </ul>
    </div>
</div>
<div class="widget widget_nav_menu">
    <h4 class="widget-title">Clothing & Apparel:</h4>
    <div class="menu-footer">
        <ul id="menu-footer-link" class="menu">
            <li><a href="#">Printers</a></li>
            <li><a href="#">Projectors</a></li>
            <li><a href="#">Scanners</a></li>
            <li><a href="#">Store & Business</a></li>
            <li><a href="#">4K Ultra HD TVs</a></li>
            <li><a href="#">LED TVs</a></li>
            <li><a href="#">OLED TVs</a></li>
        </ul>
    </div>
</div>
<div class="widget widget_nav_menu">
    <h4 class="widget-title">Home, Garden & Kitchen:</h4>
    <div class="menu-footer">
        <ul id="menu-footer-link" class="menu">
            <li><a href="#">Cookware</a></li>
            <li><a href="#">Decoration</a></li>
            <li><a href="#">Furniture</a></li>
            <li><a href="#">Garden Tools</a></li>
            <li><a href="#">Powers And Hand Tools</a></li>
            <li><a href="#">Utensil & Gadget</a></li>
        </ul>
    </div>
</div>
<div class="widget widget_nav_menu">
    <h4 class="widget-title">Health & Beauty:</h4>
    <div class="menu-footer">
        <ul id="menu-footer-link" class="menu">
            <li><a href="#">Hair Care</a></li>
            <li><a href="#">Makeup</a></li>
            <li><a href="#">Body Shower</a></li>
            <li><a href="#">Skin Care</a></li>
            <li><a href="#">Cologine</a></li>
            <li><a href="#">Perfume</a></li>
        </ul>
    </div>
</div>
<div class="widget widget_nav_menu">
    <h4 class="widget-title">Jewelry & Watches:</h4>
    <div class="menu-footer">
        <ul id="menu-footer-link" class="menu">
            <li><a href="#">Necklace</a></li>
            <li><a href="#">Pendant</a></li>
            <li><a href="#">Diamond Ring</a></li>
            <li><a href="#">Sliver Earing</a></li>
            <li><a href="#">Leather Watcher</a></li>
            <li><a href="#">Rolex</a></li>
            <li><a href="#">Gucci</a></li>
        </ul>
    </div>
</div>
<div class="widget widget_nav_menu">
    <h4 class="widget-title">Computer & Technologies:</h4>
    <div class="menu-footer">
        <ul id="menu-footer-link" class="menu">
            <li><a href="#">Desktop PC</a></li>
            <li><a href="#">Laptop</a></li>
            <li><a href="#">Smartphones</a></li>
            <li><a href="#">Tablet</a></li>
            <li><a href="#">Game Controller</a></li>
            <li><a href="#">Audio & Video</a></li>
            <li><a href="#">Wireless Speaker</a></li>
            <li><a href="#">Drone</a></li>
        </ul>
    </div>
</div>',
                        'create_user'   =>  1,
                        'update_user'   =>  1
                    ],
                ]
            );
        }
}
