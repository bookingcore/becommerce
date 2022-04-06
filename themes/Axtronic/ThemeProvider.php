<?php


namespace Themes\Axtronic;


use Modules\Template\BlockManager;
use Modules\Theme\Abstracts\AbstractThemeProvider;
use Themes\Axtronic\Controllers\Blocks\ListProduct;

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
            ["list_product",ListProduct::class]
        ]);
    }
}
