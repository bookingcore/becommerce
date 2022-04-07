<?php
namespace Themes\Freshen;


use Modules\Core\Helpers\SettingManager;

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
