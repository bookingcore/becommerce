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
        DB::table('core_menus')->insert([
            'name'        => 'Menu Department',
            'items'       => json_encode($menu_department),
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]);

        setting_update_items(
            [
                [
                    'name'  => 'freshen_logo_light',
                    'val'   => '',
                ],
                [
                    'name'  => 'freshen_logo_dark',
                    'val'   => '',
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
                    'val'   => '',
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

    }

    public function generalMenuDepartment($locale = ''){
        return  array(
            array(
                'name'       => 'Home',
                'url'        => '/',
                'item_model' => 'custom',
                'model_name' => 'Custom',
                'children'   => array(
                    array(
                        'name'       => 'Home Page',
                        'url'        => '/',
                        'item_model' => 'custom',
                        'children'   => array(),
                    ),
                    array(
                        'name'       => 'Home v2',
                        'url'        => '/page/home-v2',
                        'item_model' => 'custom',
                        'children'   => array(),
                    ),
                ),
            ),
        );
    }
}
