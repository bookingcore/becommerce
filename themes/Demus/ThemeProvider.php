<?php


namespace Themes\Demus;

use Modules\Core\Helpers\SettingManager;
use Illuminate\Http\Request;
use Modules\Page\Hook;
use Modules\Page\Models\Page;
use Modules\Template\BlockManager;
use Modules\Theme\Abstracts\AbstractThemeProvider;


class ThemeProvider extends AbstractThemeProvider
{
    public static $name = "demus";

    public static $screenshot = "/themes/demus/screenshot.png";

//    public static $seeder = Seeder::class;

    public static function info()
    {
        // TODO: Implement info() method.
        return [

        ];
    }

    public function boot()
    {
        BlockManager::register([
        ]);

        add_action(Hook::FORM_AFTER_DISPLAY_TYPE,[$this,'__show_header_style']);
        add_action(Hook::AFTER_SAVING,[$this,'__save_header_style']);
        add_action(Hook::FORM_AFTER_DISPLAY_TYPE,[$this,'__show_footer_style']);

        SettingManager::register("demus_general",[$this,'registerAdvanceSetting'],1,'demus_theme');
        SettingManager::register("demus_product",[$this,'registerProductSetting'],1,'demus_theme');
        SettingManager::registerZone('demus_theme',[$this,'registerZone']);
    }

    public function __show_header_style(Page $row){
        echo view('admin.page.header_style',['row'=>$row]);
    }
    public function __show_footer_style(Page $row){
        echo view('admin.page.footer_style',['row'=>$row]);
    }
    public function __save_header_style(Page $row,Request $request){
        if($request->input('save_header_style')){
            $row->addMeta("header_style",$request->input('header_style'));
        }
        if($request->input('save_footer_style')){
            $row->addMeta("footer_style",$request->input('footer_style'));
        }
    }
    public function registerZone(){
        return [
            "position"=>71,
            'title'      => __("Demus Settings"),
            'icon'       => 'fa fa-object-group',
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
            'id'   => 'demus_general',
            'title' => __("General Settings"),
            'position'=>80,
            'view'      => "admin.settings.general",
            "keys"      => [
                'demus_logo_light',
                'demus_logo_dark',
                'demus_header_contact',
                'demus_header_style',
                'demus_footer_style',
                'demus_footer_bg_image',
                'demus_hotline_contact',
                'demus_email_contact',
                'demus_list_widget_footer',
                'demus_footer_info_text',
                'demus_footer_text_right',
                'demus_copyright',
                'demus_hotline_text',
                'demus_footer_text_subscribe',
            ],
            'filter_demo_mode'=>[
            ]
        ];
    }
//    public function registerProductSetting(){
//        return [
//            'id'   => 'demus_product',
//            'title' => __("Product Settings"),
//            'position'=>80,
//            'view'      => "admin.settings.product",
//            "keys"      => [
//                'demus_product_category'
//            ],
//            'filter_demo_mode'=>[
//            ]
//        ];
//    }
}
