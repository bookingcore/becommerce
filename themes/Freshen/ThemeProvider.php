<?php
namespace Themes\Freshen;


use Modules\Core\Helpers\SettingManager;
use Modules\News\Hook;

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
        SettingManager::register("advance",[$this,'registerAdvanceSetting']);
        add_filter(Hook::NEWS_SETTING_CONFIG,[$this,'alterSettings']);
        add_action(Hook::NEWS_SETTING_AFTER_DESC,[$this,'showCustomFields']);
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
            'id'   => 'advance',
            'title' => __("Freshen Settings"),
            'position'=>80,
            'view'      => "admin.settings.general",
            "keys"      => [
                'freshen_footer_style',
                'freshen_footer_bg_image',
                'freshen_hotline_contact',
                'freshen_email_contact',
            ],
            'filter_demo_mode'=>[
            ]
        ];
    }
}
