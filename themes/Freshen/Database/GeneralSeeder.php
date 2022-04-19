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
                    'name'  => 'freshen_footer_bg_image',
                    'val'   => $bg_footer_1->id,
                ],
                [
                    'name'  => 'freshen_list_widget_footer',
                    'val'   => '',
                ],
                [
                    'name'  => 'freshen_footer_info_text',
                    'val'   => '',
                ],
                [
                    'name'  => 'freshen_footer_text_right',
                    'val'   => '',
                ],
                [
                    'name'  => 'freshen_copyright',
                    'val'   => '',
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
