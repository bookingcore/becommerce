<?php
namespace Themes\Freshen;


use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Artisan;
use Modules\Core\Helpers\SettingManager;
use Modules\News\Hook;
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

        SettingManager::register("freshen_general",[$this,'registerGeneralSetting'],1,'freshen_theme');
        SettingManager::register("freshen_product",[$this,'registerProductSetting'],1,'freshen_theme');
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

        if(!is_admin_dashboard()){
        Paginator::defaultView('pagination');
        }
    }

    public function registerZone(){
        return [
            "position"=>10,
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
            ],
            'filter_demo_mode'=>[
            ]
        ];
    }
}
