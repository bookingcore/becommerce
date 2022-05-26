<?php
namespace Themes\Freshen;


use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Artisan;
use Modules\Core\Helpers\SettingManager;
use Modules\News\Hook;
use Modules\Page\Models\Page;
use Modules\Template\BlockManager;
use Themes\Freshen\Database\Seeder;

class ThemeProvider extends \Modules\Theme\Abstracts\AbstractThemeProvider
{

    public static $name = "Freshen";

    public static $version = '1.0';

    public static $screenshot = "/themes/Freshen/screenshot.png";

    public static $seeder = Seeder::class;

    public static function info()
    {
        return [

        ];
    }

    public function register()
    {
        $this->app->register(RouterServiceProvider::class);

    }

    public function boot(){

        add_filter(Hook::NEWS_SETTING_CONFIG,[$this,'alterSettings']);
        add_action(Hook::NEWS_SETTING_AFTER_DESC,[$this,'showCustomFields']);

        add_action(\Modules\Page\Hook::FORM_AFTER_DISPLAY_TYPE,[$this,'__show_header_style']);
        add_action(\Modules\Page\Hook::FORM_AFTER_DISPLAY_TYPE,[$this,'__show_footer_style']);
        add_action(\Modules\Page\Hook::AFTER_SAVING,[$this,'__save_header_footer_style']);

        SettingManager::register("freshen_general",[$this,'registerGeneralSetting'],1,'freshen_theme');
        SettingManager::register("freshen_product",[$this,'registerProductSetting'],1,'freshen_theme');
        SettingManager::register("freshen_style",[$this,'registerStyleSetting'],1,'freshen_theme');
        SettingManager::registerZone('freshen_theme',[$this,'registerZone']);

        BlockManager::register("list_category",\Themes\Freshen\Controllers\Blocks\ListCategory::class);
        BlockManager::register("promotion",\Themes\Freshen\Controllers\Blocks\Promotion::class );
        BlockManager::register("deliver",\Themes\Freshen\Controllers\Blocks\Deliver::class );
        BlockManager::register("why_chose_us",\Themes\Freshen\Controllers\Blocks\WhyChoseUs::class );
        BlockManager::register("instagram",\Themes\Freshen\Controllers\Blocks\Instagram::class );
        BlockManager::register("list_partner",\Themes\Freshen\Controllers\Blocks\ListPartner::class );
        BlockManager::register("list_news",\Themes\Freshen\Controllers\Blocks\ListNews::class );
        BlockManager::register("list_category_product",\Themes\Freshen\Controllers\Blocks\ListCategoryProduct::class );
        BlockManager::register("banner_slider_v2",\Themes\Freshen\Controllers\Blocks\BannerSlider::class );
        BlockManager::register("product_in_category",\Themes\Freshen\Controllers\Blocks\ProductInCategory::class );
        BlockManager::register("whats_app",\Themes\Freshen\Controllers\Blocks\WhatsApp::class );
        BlockManager::register("breadcrumb",\Themes\Freshen\Controllers\Blocks\Breadcrumb::class );
        BlockManager::register("about_text",\Themes\Freshen\Controllers\Blocks\AboutText::class );
        BlockManager::register("testimonial",\Themes\Freshen\Controllers\Blocks\Testimonial::class );
        BlockManager::register("our_teams",\Themes\Freshen\Controllers\Blocks\OurTeams::class );
        BlockManager::register("list_logos",\Themes\Freshen\Controllers\Blocks\ListLogos::class );
        BlockManager::register("subscribe",\Themes\Freshen\Controllers\Blocks\Subscribe::class );
        BlockManager::register("list_product",\Themes\Freshen\Controllers\Blocks\ListProduct::class);


        if(!is_admin_dashboard()){
        Paginator::defaultView('pagination');
        }
    }
    public function __show_header_style(Page $row){
        echo view('admin.page.header_style',['row'=>$row]);
    }
    public function __show_footer_style(Page $row){
        echo view('admin.page.footer_style',['row'=>$row]);
    }
    public function __save_header_footer_style(Page $row,Request $request){
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
            'title'      => __("Freshen Settings"),
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
    public function registerGeneralSetting(){
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
                'freshen_footer_mobile_menu_info',
                'freshen_footer_text_right',
                'freshen_copyright',
            ],
            'filter_demo_mode'=>[
            ]
        ];
    }
    public function registerProductSetting(){

        return [
            'id'   => 'freshen_product',
            'title' => __("Product Settings"),
            'position'=>80,
            'view'      => "admin.settings.product",
            "keys"      => [
                'freshen_product_gallery',

                'fs_search_layout',
                'fs_search_item_layout',
                'fs_search_top_product_ids',
                'fs_search_top_category_ids',
                'fs_search_top_carousel',

                'fs_products_sidebar',

            ],
            'filter_demo_mode'=>[
            ]
        ];
    }
    public function registerStyleSetting(){
        return [
            'id'   => 'freshen_style',
            'title' => __("Style Settings"),
            'position'=>80,
            'view'      => "admin.settings.style",
            "keys"      => [
                'freshen_enable_preloader',
                'freshen_style_main_color',
                'freshen_style_typo',
            ],
            'filter_demo_mode'=>[

            ]
        ];
    }
}
