<?php
namespace Themes\Demus;

use Modules\Core\Helpers\SettingManager;
use Modules\Template\BlockManager;
use Modules\Theme\Abstracts\AbstractThemeProvider;
use Modules\Theme\ThemeManager;
use Themes\Demus\Controllers\Blocks\BannerSlider;
use Themes\Demus\Controllers\Blocks\Gap;
use Themes\Demus\Controllers\Blocks\ListProduct;
use Themes\Demus\Database\Seeder;
use Modules\Page\Hook;
use Modules\Page\Models\Page;
use Illuminate\Http\Request;

class ThemeProvider extends AbstractThemeProvider
{

    public static $name = "Demus";

    public static $version = '1.1';

    public static $seeder = Seeder::class;

    public static $screenshot = "/themes/Demus/screenshot.png";

    public static function info()
    {
        return [

        ];
    }

    public function boot(){
        $active = ThemeManager::current();
        if(strtolower($active) == "demus"){
            SettingManager::register("demus_advance",[$this,'registerAdvanceSetting'],1,'demus_theme');
            SettingManager::registerZone('demus_theme',[$this,'registerZone']);
        }
        add_action(Hook::FORM_AFTER_DISPLAY_TYPE,[$this,'__show_header_style']);
        add_action(Hook::AFTER_SAVING,[$this,'__save_header_style']);
        add_action(Hook::FORM_AFTER_DISPLAY_TYPE,[$this,'__show_footer_style']);

        BlockManager::register([
            ["gap", Gap::class],
            ["slider", BannerSlider::class],
            ["productlist", ListProduct::class],

        ]);
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
        if($request->input('save_header_width')){
            $row->addMeta("header_width",$request->input('header_width'));
        }
        if($request->input('save_footer_style')){
            $row->addMeta("footer_style",$request->input('footer_style'));
        }
    }

    public function registerZone(){
        return [
            "position"=>71,
            'title'      => __("Theme Settings"),
            'icon'       => 'fa fa-object-group',
            'permission' => 'setting_update',
            "group"=>"system"
        ];
    }

    public function register()
    {
        parent::register(); // TODO: Change the autogenerated stub

        $this->app->register(RouterServiceProvider::class);
    }

    public function registerAdvanceSetting(){
        return [
            'id'   => 'demus_general',
            'title' => __("General Settings"),
            'position'=>80,
            'view'      => "admin.settings.general",
            "keys"      => [
                'demus_logo_dark',
                'demus_header_style',
                'demus_header_width',
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
}