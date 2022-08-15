<?php
namespace Themes\Demus;

use Modules\Core\Helpers\SettingManager;
use Modules\Template\BlockManager;
use Themes\Demus\Controllers\Blocks\CategoryProductList;
use Themes\Demus\Controllers\Blocks\FeaturedIcon;
use Modules\Theme\Abstracts\AbstractThemeProvider;
use Modules\Theme\ThemeManager;
use Themes\Demus\Controllers\Blocks\Instagram;
use Themes\Demus\Controllers\Blocks\ListCategoryProduct;
use Themes\Demus\Controllers\Blocks\NewsList;
use Themes\Demus\Controllers\Blocks\Slider;
use Themes\Demus\Controllers\Blocks\Gap;
use Themes\Demus\Controllers\Blocks\ListProduct;
use Themes\Demus\Controllers\Blocks\Subscribe;
use Themes\Demus\Controllers\Blocks\Testimonial;
use Themes\Demus\Controllers\Blocks\Title;
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
            SettingManager::register("demus_product",[$this,'registerProductSetting'],1,'demus_theme');
            SettingManager::register("demus_style",[$this,'registerStyleSetting'],1,'demus_theme');
            SettingManager::register("demus_social",[$this,'registerSocialSetting'],1,'demus_theme');
            SettingManager::registerZone('demus_theme',[$this,'registerZone']);
        }
        add_action(Hook::FORM_AFTER_DISPLAY_TYPE,[$this,'__show_header_style']);
        add_action(Hook::AFTER_SAVING,[$this,'__save_header_style']);
        add_action(Hook::FORM_AFTER_DISPLAY_TYPE,[$this,'__show_footer_style']);

        BlockManager::register([
            ["gap", Gap::class],
            ["slider", Slider::class],
            ["productlist", ListProduct::class],
            ["featured_icon", FeaturedIcon::class],
            ["title", Title::class],
            ["instagram", Instagram::class],
            ["news", NewsList::class],
            ["product_tab", ListCategoryProduct::class],
            ["testimonial", Testimonial::class],
            ["category", CategoryProductList::class],
            ["subcribe", Subscribe::class],
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
                'demus_footer_style',
                'demus_list_widget_footer',
                'demus_footer_info_text',
                'demus_footer_text_right',
                'demus_copyright',
                'demus_footer_text_subscribe',
                'demus_footer_bg_color',
                'demus_logo_footer',
            ],
            'filter_demo_mode'=>[
            ]
        ];
    }
    public function registerProductSetting(){

        return [
            'id'        => 'demus_product',
            'title'     => __("Product Settings"),
            'position'  =>80,
            'view'      => "admin.settings.product",
            "keys"      => [
                'demus_product_gallery',
                'fs_search_layout',
                'fs_search_item_layout',
                'fs_products_sidebar',
            ],
            'filter_demo_mode'=>[
            ]
        ];
    }
    public function registerStyleSetting(){
        return [
            'id'   => 'demus_style',
            'title' => __("Style Settings"),
            'position'=>80,
            'view'      => "admin.settings.style",
            "keys"      => [
                'demus_enable_scroll',
                'demus_enable_header_scroll',
            ],
            'filter_demo_mode'=>[

            ]
        ];
    }
    public function registerSocialSetting(){
        return [
            'id'        => 'demus_social',
            'title'     => __("Social Settings"),
            'position'  =>80,
            'view'      => "admin.settings.social",
            "keys"      => [
                'demus_social_facebook',
                'demus_social_twitter',
                'demus_social_instagram',
                'demus_social_linkedin',
                'demus_social_pinterest',
            ],
            'filter_demo_mode'=>[

            ]
        ];
    }
}
