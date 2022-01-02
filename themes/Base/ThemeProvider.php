<?php
namespace Themes\Base;

use Modules\Vendor\VendorMenuManager;

class ThemeProvider extends \Modules\Theme\Abstracts\AbstractThemeProvider
{

    public static $name = "Default Theme";

    public static $screenshot = "/screenshot.png";

    public static function info()
    {
        return [

        ];
    }

    public function boot(){
        VendorMenuManager::register("product",[$this,'addVendorMenu']);
    }

    public function addVendorMenu(){
        return [
            'product'=>[
                'url'=>route('vendor.product'),
                'title'=>__("Products"),
                "icon"=>"icon-database"
            ],
            'order'=>[
                'url'=>route('vendor.order'),
                'title'=>__("Orders"),
                "icon"=>"icon-bag2"
            ]
        ];
    }

    public function register()
    {
        parent::register(); // TODO: Change the autogenerated stub

        $this->app->register(RouterServiceProvider::class);
    }
}
