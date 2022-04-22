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
        $menu_department = $this->generalMenuDepartment();
        DB::table('core_menus')->insertGetId([
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
        ];
        $templlate_id = DB::table('core_templates')->insertGetId(
            [
                'title' =>  'Freshen Home Page 1',
                'content'   =>  '[{"type":"banner_slider","name":"Banner Slider","model":{"sliders":[{"_active":false,"title":"<span class=\"text-thm2 fwb\">Healthy Food</span> <br><span class=\"text-thm fw400\">&amp; Organic Market</span>","sub_title":"ALL NATURAL PRODUCTS.","image":'.$freshen_home_1['freshen-banner-slider-1'].',"sub_text":"<strong>Organic food</strong> is food produced by methods that comply with the standards of organic farming.","btn_shop_now":"Shop Now","link_shop_now":"#"},{"_active":false,"title":"<span class=\"text-thm2 fwb\">Double Combo</span> <span class=\"text-thm fw400\">With The Body Shop</span>","sub_title":"Mega Sale Nov 2022","image":'.$freshen_home_1['freshen-banner-slider-1'].',"sub_text":"Discount <strong>70% Off </strong>","btn_shop_now":"Shop now","link_shop_now":"#"}],"width_slider":"container"},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_category","name":"List Category","model":{"title":"TOP CATEGORIES OF THE MONTH","list_items":[{"_active":true,"category_id":"7","image_id":'.$freshen_home_1['freshen-cat-1'].'},{"_active":true,"category_id":"8","image_id":'.$freshen_home_1['freshen-cat-2'].'},{"_active":true,"category_id":"5","image_id":'.$freshen_home_1['freshen-cat-3'].'},{"_active":true,"category_id":"6","image_id":'.$freshen_home_1['freshen-cat-4'].'},{"_active":true,"category_id":"2","image_id":'.$freshen_home_1['freshen-cat-5'].'}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"promotion","name":"Promotion","model":{"col":"3","list_items":[{"_active":true,"image":'.$freshen_home_1['freshen-promotion-1'].',"title":"FRESH SUMMER WITH JUST $200.99","link":"#","sub_title":"FRESH FRUIT"},{"_active":true,"image":'.$freshen_home_1['freshen-promotion-2'].',"title":"UP TO BREADS <span class=\"text-thm2\">50% Off</span>","link":"#","sub_title":"SEASONAL SALE"},{"_active":true,"image":'.$freshen_home_1['freshen-promotion-3'].',"link":"#","title":"FRESH <span class=\"text-thm2\">Vegetables</span>","sub_title":"TASTY HEALTHY"}],"title":"Promotion","sub_title":"Recommended for you"},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_category_product","name":"Product: List Tab Category","model":{"title":"FEATURED PRODUCTS","cat_ids":["8","6","4","7"],"number":8,"order":"id","order_by":"desc"},"component":"RegularBlock","open":true,"is_container":false},{"type":"deliver","name":"Deliver Divider","model":{"title":"WHATSAPP ORDERING SERVICE – PLACE YOUR ORDERS AT ","phone":"392 96 32","image_id":'.$freshen_home_1['freshen-delivery'].'},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_product","name":"Product: List item","model":{"style_list":"","title":"Newsest Products","sub_title":"Recommended for you","cat_ids":"","number":8,"order":"id","order_by":"desc","is_featured":""},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_partner","name":"List Partner","model":{"sub_title":"ORANGE JUICE","title":"FOR HUMAN HEALTH","desc":"Organic food is food produced by methods that comply with the standards of organic farming. Standards vary worldwide, but organic farming in general features.","link_shop":"#","bg_image":'.$freshen_home_1['freshen-partner-bg-1'].',"list_items":[{"_active":true,"image_id":'.$freshen_home_1['freshen-logo-partner-1'].'},{"_active":true,"image_id":'.$freshen_home_1['freshen-logo-partner-2'].'},{"_active":true,"image_id":'.$freshen_home_1['freshen-logo-partner-3'].'},{"_active":true,"image_id":'.$freshen_home_1['freshen-logo-partner-4'].'},{"_active":true,"image_id":'.$freshen_home_1['freshen-logo-partner-5'].'}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_news","name":"News: List Items","model":{"title":"OUR BLOG","number":3,"category_id":"","order":"id","order_by":"desc"},"component":"RegularBlock","open":true,"is_container":false},{"type":"why_chose_us","name":"Why Chose Us","model":{"title":"WHY CHOOSE US","list_items":[{"_active":true,"title":"WE DRIVE FAST & SHIP FASTER","desc":"Sed semper convallis ultricies. Aliqua erat vol esent friday ngilla augue.","image_id":'.$freshen_home_1['freshen-why-chose-1'].'},{"_active":true,"title":"WE SAVE YOUR MORE MONEY","desc":"Sed semper convallis ultricies. Aliqua erat vol esent friday ngilla augue.","image_id":'.$freshen_home_1['freshen-why-chose-2'].'},{"_active":true,"title":"DAILY DISCOUNT COUPONS","desc":"Sed semper convallis ultricies. Aliqua erat vol esent friday ngilla augue.","image_id":'.$freshen_home_1['freshen-why-chose-3'].'}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"instagram","name":"Instagram","model":{"title":"FOLLOW @FRESHEN ON INSTAGRAM","list_items":[{"_active":true,"image_id":'.$freshen_home_1['freshen-insta-1'].'},{"_active":false,"image_id":'.$freshen_home_1['freshen-insta-2'].'},{"_active":false,"image_id":'.$freshen_home_1['freshen-insta-3'].'},{"_active":false,"image_id":'.$freshen_home_1['freshen-insta-4'].'},{"_active":false,"image_id":'.$freshen_home_1['freshen-insta-5'].'}]},"component":"RegularBlock","open":true,"is_container":false}]',
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
                'content'   =>  '[{"type":"banner_slider_v2","name":"Banner Slider V2","model":{"style":"style_1","sliders":[{"_active":true,"title":"<span class=\"fwb\">Get fresher food</span><br><span class=\"text-thm fw400\">every days</span>","sub_title":"All natural products ","image":'. $freshen_home_2['freshen-banner-slider-1'] .',"sub_text":"<span class=\"fwb\">Organic food</span> is food produced by methods that comply with the <br> standards of organic farming.","btn_shop_now":"SHOP NOW","link_shop_now":"#"},{"_active":true,"title":"<span class=\"fwb\">Healthy Food</span><br><span class=\"text-thm fw400\">&amp; Organic Market</span>","sub_title":"<span class=\"fwb\">Organic food</span> is food produced by methods that comply with the <br> standards of organic farming.","image":'. $freshen_home_2['freshen-banner-slider-1'] .',"sub_text":"All natural products ","btn_shop_now":"SHOP NOW","link_shop_now":"#"}],"sliders_2":[{"_active":true,"title":"Up To Breads ","sub_title":"SEASONAL SALE","image":'. $freshen_home_2['freshen-banner-slider-2'] .',"sub_text":"50% OFF","btn_shop_now":"SHOP NOW","link_shop_now":"#"},{"_active":true,"title":"Fresh Vegetables","sub_title":"Tasty Healthy","image":'. $freshen_home_2['freshen-banner-slider-3'] .',"sub_text":"","btn_shop_now":"SHOP NOW","link_shop_now":"#"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"why_chose_us","name":"Why Chose Us","model":{"title":"","list_items":[{"_active":true,"title":"WE DRIVE FAST & SHIP FASTER","desc":"Sed semper convallis ultricies. Aliqua erat vol esent friday ngilla augue","image_id":'. $freshen_home_2['freshen-why-chose-1'] .'},{"_active":true,"title":"WE SAVE YOUR MORE MONEY","desc":"Sed semper convallis ultricies. Aliqua erat vol esent friday ngilla augue.","image_id":'. $freshen_home_2['freshen-why-chose-2'] .'},{"_active":true,"title":"DAILY DISCOUNT COUPONS","desc":"Sed semper convallis ultricies. Aliqua erat vol esent friday ngilla augue.","image_id":'. $freshen_home_2['freshen-why-chose-3'] .'}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"product_in_category","name":"Product: In Category","model":{"style":"style_1","title":"FRUITS","category_id":"37","number":6,"order":"id","order_by":"desc","load_more_url":"#","load_more_name":"VIEW ALL","bg_image":'. $freshen_home_2['banner-1'] .',"bg_title":"FRESH SUMMER WITH JUST $200.99","bg_sub_title":"FRESH FRUIT","link_apply":"SHOP NOW","url_apply":"#"},"component":"RegularBlock","open":true,"is_container":false},{"type":"product_in_category","name":"Product: In Category","model":{"style":"","title":"VEGETABLES","category_id":"","number":6,"order":"id","order_by":"desc","load_more_url":"#","load_more_name":"VIEW ALL","bg_image":'. $freshen_home_2['banner-2'] .',"bg_title":"FRESH VEGETABLES","bg_sub_title":"TASTY HEALTHY","link_apply":"SHOP NOW","url_apply":"#"},"component":"RegularBlock","open":true,"is_container":false},{"type":"product_in_category","name":"Product: In Category","model":{"style":"style_1","title":"FOOD & GROCERY","category_id":"37","number":6,"order":"id","order_by":"desc","load_more_url":"#","load_more_name":"VIEW ALL","bg_image":'. $freshen_home_2['banner-3'] .',"bg_title":"SEASON DISCOUNT","bg_sub_title":"20% OFF","link_apply":"SHOP NOW","url_apply":"#"},"component":"RegularBlock","open":true}]',
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
