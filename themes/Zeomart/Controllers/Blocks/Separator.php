<?php
namespace Themes\Zeomart\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;

class Separator extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [

            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('Separator');
    }

    public function content($model = [])
    {
        return view("global.separator");
    }
}
