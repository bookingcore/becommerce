<?php
namespace Themes\Zeomart;

use Illuminate\Pagination\Paginator;
use Modules\Core\Helpers\SettingManager;
use Modules\Template\BlockManager;
use Modules\Theme\Abstracts\AbstractThemeProvider;
use Themes\Zeomart\Database\Seeder;

class ThemeProvider extends AbstractThemeProvider
{


    public static $name = "ZeoMart";

    public static $version = '1.0';

    public static $seeder = Seeder::class;

    public function register()
    {

        $this->app->register(RouterServiceProvider::class);
    }

    public function boot(){

        //add_filter(Hook::NEWS_SETTING_CONFIG,[$this,'alterSettings']);
        //add_action(Hook::NEWS_SETTING_AFTER_DESC,[$this,'showCustomFields']);

        SettingManager::registerZone('zeomart_theme',[$this,'registerZone']);
        SettingManager::register("zeomart_general",[$this,'registerGeneralSetting'],1,'zeomart_theme');
        //SettingManager::register("zeomart_product",[$this,'registerProductSetting'],1,'zeomart_theme');
        //SettingManager::register("zeomart_style",[$this,'registerStyleSetting'],1,'zeomart_theme');
        if(!is_admin_dashboard()){
            Paginator::defaultView('global.pagination');
        }

        BlockManager::register('about_gallery', \Themes\Zeomart\Controllers\Blocks\AboutGallery::class);
        BlockManager::register('about_editor', \Themes\Zeomart\Controllers\Blocks\AboutEditor::class);
        BlockManager::register('banner_slider', \Themes\Zeomart\Controllers\Blocks\BannerSlider::class);
        BlockManager::register('featured_icon', \Themes\Zeomart\Controllers\Blocks\FeaturedIcon::class);
    }

    public function registerZone(){
        return [
            "position"=>71,
            'title'      => __("Zeomart Settings"),
            'icon'       => 'fa fa-object-group',
            'permission' => 'setting_update',
            "group"=>"system"
        ];
    }

    public function registerGeneralSetting(){
        return [
            'id'   => 'zeomart_theme',
            'title' => __("General Settings"),
            'position'=>80,
            'view'      => "admin.settings.general",
            "keys"      => [
                'zeomart_logo_text',
                'zeomart_logo',
                'zeomart_hotline_contact',
                'zeomart_email_contact',
                'zeomart_header_style',

                'zeomart_topbar_text_left',
                'zeomart_topbar_text_right',

                'zeomart_footer_info_text',
                'zeomart_list_widget_footer',
                'zeomart_copyright',
                'zeomart_footer_text_right',
            ],
            'filter_demo_mode'=>[
            ]
        ];
    }

}
