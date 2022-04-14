<?php


namespace Themes\Axtronic;


use Illuminate\Http\Request;
use Modules\Page\Hook;
use Modules\Page\Models\Page;
use Modules\Template\BlockManager;
use Modules\Theme\Abstracts\AbstractThemeProvider;
use Themes\Axtronic\Controllers\Blocks\Brands;
use Themes\Axtronic\Controllers\Blocks\CategoryProduct;
use Themes\Axtronic\Controllers\Blocks\ListProduct;
use Themes\Axtronic\Controllers\Blocks\RecentNews;
use Themes\Axtronic\Controllers\Blocks\Testimonial;

class ThemeProvider extends AbstractThemeProvider
{
    public static $name = "Axtronic";

    public static function info()
    {
        // TODO: Implement info() method.
    }

    public function boot()
    {
        BlockManager::register([
            ["list_product",ListProduct::class],
            ["block_news",RecentNews::class],
            ["brand_slider",Brands::class],
            ["testimonial",Testimonial::class],
            ["category_product",CategoryProduct::class],
        ]);

        add_action(Hook::FORM_AFTER_DISPLAY_TYPE,[$this,'__show_header_style']);
        add_action(Hook::AFTER_SAVING,[$this,'__save_header_style']);
    }
    public function __show_header_style(Page $row){
        echo view('admin.page.header_style',['row'=>$row]);
    }
    public function __save_header_style(Page $row,Request $request){
        if($request->input('save_header_style')){
            $row->addMeta("header_style",$request->input('header_style'));
        }
    }
}
