<?php


namespace Themes\Axtronic;

use Modules\Core\Helpers\SettingManager;
use Illuminate\Http\Request;
use Modules\Page\Hook;
use Modules\Page\Models\Page;
use Modules\Template\BlockManager;
use Modules\Theme\Abstracts\AbstractThemeProvider;
use Themes\Axtronic\Controllers\Blocks\BannerProduct;
use Themes\Axtronic\Controllers\Blocks\BannerText;
use Themes\Axtronic\Controllers\Blocks\Brands;
use Themes\Axtronic\Controllers\Blocks\CategoryProduct;
use Themes\Axtronic\Controllers\Blocks\FeaturedIcon;
use Themes\Axtronic\Controllers\Blocks\Gap;
use Themes\Axtronic\Controllers\Blocks\ListProduct;
use Themes\Axtronic\Controllers\Blocks\ProductFeature;
use Themes\Axtronic\Controllers\Blocks\ProductTab;
use Themes\Axtronic\Controllers\Blocks\RecentNews;
use Themes\Axtronic\Controllers\Blocks\Testimonial;
use Themes\Axtronic\Database\Seeder;
use Themes\Axtronic\Controllers\Blocks\BannerSliderStyle2;
use Themes\Axtronic\Controllers\Blocks\ListCategoryProduct;

class ThemeProvider extends AbstractThemeProvider
{
    public static $name = "Axtronic";

    public static $screenshot = "/themes/Axtronic/screenshot.png";

    public static $seeder = Seeder::class;

    public static function info()
    {
        // TODO: Implement info() method.
        return [

        ];
    }

    public function boot()
    {
        BlockManager::register([
            ["list_product",ListProduct::class],
            ["block_news",RecentNews::class],
            ["brand_slider",Brands::class],
            ["testimonial",Testimonial::class],
            ["category_product",CategoryProduct::class],
            ["list_category_product",ListCategoryProduct::class],
            ["banner_slider_v2", BannerSliderStyle2::class],
            ["banner_text", BannerText::class],
            ["featured_icon_2", FeaturedIcon::class],
            ["banner_product", BannerProduct::class],
            ["product_feature", ProductFeature::class],
            ["gap", Gap::class],
            ["product_tab", ProductTab::class],
        ]);

        add_action(Hook::FORM_AFTER_DISPLAY_TYPE,[$this,'__show_header_style']);
        add_action(Hook::AFTER_SAVING,[$this,'__save_header_style']);
        add_action(Hook::FORM_AFTER_DISPLAY_TYPE,[$this,'__show_footer_style']);

        SettingManager::register("axtronic_general",[$this,'registerAdvanceSetting'],1,'axtronic_theme');
        SettingManager::register("axtronic_product",[$this,'registerProductSetting'],1,'axtronic_theme');
        SettingManager::registerZone('axtronic_theme',[$this,'registerZone']);
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
            'title'      => __("Axtronic Settings"),
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
            'id'   => 'axtronic_general',
            'title' => __("General Settings"),
            'position'=>80,
            'view'      => "admin.settings.general",
            "keys"      => [
                'axtronic_logo_light',
                'axtronic_logo_dark',
                'axtronic_header_contact',
                'axtronic_header_style',
                'axtronic_footer_style',
                'axtronic_footer_bg_image',
                'axtronic_hotline_contact',
                'axtronic_email_contact',
                'axtronic_list_widget_footer',
                'axtronic_footer_info_text',
                'axtronic_footer_text_right',
                'axtronic_copyright',
                'axtronic_hotline_text',
                'axtronic_footer_text_subscribe',
            ],
            'filter_demo_mode'=>[
            ]
        ];
    }
//    public function registerProductSetting(){
//        return [
//            'id'   => 'axtronic_product',
//            'title' => __("Product Settings"),
//            'position'=>80,
//            'view'      => "admin.settings.product",
//            "keys"      => [
//                'axtronic_product_category'
//            ],
//            'filter_demo_mode'=>[
//            ]
//        ];
//    }
}
