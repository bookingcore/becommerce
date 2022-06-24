<?php


namespace Themes\Educrat;


use Modules\Core\Helpers\SettingManager;
use Modules\Theme\Abstracts\AbstractThemeProvider;

class ThemeProvider extends AbstractThemeProvider
{


    public static $name = "Educrat";

    public static $version = '1.0';

    public static $seeder = \Themes\Educrat\Database\Seeder::class;

    public function register()
    {
        $this->app->register(\Themes\Educrat\Modules\Course\ModuleProvider::class);
        $this->app->register(\Themes\Educrat\Modules\Event\ModuleProvider::class);
    }

    public function boot(){

        SettingManager::register("ec_general",[$this,'registerGeneralSetting'],1,'ec_theme');
        SettingManager::register("ec_product",[$this,'registerProductSetting'],1,'ec_theme');
        SettingManager::registerZone('ec_theme',[$this,'registerZone']);
    }

    public function registerZone(){

        return [
            "position"=>71,
            'title'      => __("Educrat Settings"),
            'icon'       => 'fa fa-object-group',
            'permission' => 'setting_update',
            "group"=>"system"
        ];
    }

    public function registerGeneralSetting(){
        return [
            'id'   => 'ec_theme',
            'title' => __("General Settings"),
            'position'=>80,
            'view'      => "admin.settings.general",
            "keys"      => [
                'ec_logo_light',
                'ec_logo_dark',
                'ec_footer_style',
                'ec_footer_bg_image',
                'ec_hotline_contact',
                'ec_email_contact',
                'ec_list_widget_footer',
                'ec_footer_info_text',
                'ec_footer_mobile_menu_info',
                'ec_footer_text_right',
                'ec_copyright',
            ],
            'filter_demo_mode'=>[
            ]
        ];
    }
    public function registerProductSetting(){

        return [
            'id'   => 'ec_product',
            'title' => __("Course Settings"),
            'position'=>80,
            'view'      => "admin.settings.product",
            "keys"      => [
                'ec_product_gallery',

                'ec_search_layout',
                'ec_search_item_layout',
                'ec_search_top_product_ids',
                'ec_search_top_category_ids',
                'ec_search_top_carousel',

                'ec_attr_level',

                'ec_products_sidebar',

            ],
            'filter_demo_mode'=>[
            ]
        ];
    }
}
