<?php
namespace Themes\Freshen;


use Modules\Core\Helpers\SettingManager;
use Modules\News\Hook;
use Modules\Template\BlockManager;

class ThemeProvider extends \Modules\Theme\Abstracts\AbstractThemeProvider
{

    public static $name = "Freshen";

    public static $screenshot = "/screenshot.png";

    public static function info()
    {
        return [

        ];
    }


    public function boot(){

        add_filter(Hook::NEWS_SETTING_CONFIG,[$this,'alterSettings']);
        add_action(Hook::NEWS_SETTING_AFTER_DESC,[$this,'showCustomFields']);

        SettingManager::register("freshen_advance",[$this,'registerAdvanceSetting'],1,'freshen_theme');
        SettingManager::registerZone('freshen_theme',[$this,'registerZone']);

        BlockManager::register("list_category",\Themes\Freshen\Controllers\Blocks\ListCategory::class);
    }
    public function registerZone(){
        return [
            "position"=>80,
            'title'      => __("Freshen Settings"),
            'icon'       => 'fa fa-cogs',
            'permission' => 'setting_update',
            "group"=>"system"
        ];
    }
    public function alterSettings($settings){
        $settings['keys'][] = 'news_page_image';
        return $settings;
    }
    public function showCustomFields(){
        echo view('news.admin.settings.image');
    }
    public function registerAdvanceSetting(){
        return [
            'id'   => 'freshen_theme',
            'title' => __("General Settings"),
            'position'=>80,
            'view'      => "admin.settings.general",
            "keys"      => [
                'freshen_logo_light',
                'freshen_logo_dark',
                'freshen_footer_style',
                'freshen_footer_bg_image',
                'freshen_hotline_contact',
                'freshen_email_contact',
                'freshen_list_widget_footer',
                'freshen_footer_info_text',
                'freshen_footer_text_right',
                'freshen_copyright',
            ],
            'filter_demo_mode'=>[
            ]
        ];
    }
}
