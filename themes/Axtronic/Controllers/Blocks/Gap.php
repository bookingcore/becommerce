<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 5/9/2022
 * Time: 8:23 PM
 */

namespace Themes\Axtronic\Controllers\Blocks;


use Modules\Template\Blocks\BaseBlock;

class Gap extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'        => 'gap',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Height')
                ],
            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('Gaps');
    }

    public function content($model = [])
    {
        return view('blocks.gap.index', $model);
    }
}
