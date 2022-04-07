<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/6/2022
 * Time: 3:38 PM
 */

namespace Themes\Axtronic\Controllers\Blocks;


use Modules\Template\Blocks\BaseBlock;

class Brands extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'          => 'brands',
                    'type'        => 'listItem',
                    'label'       => __('Slider Items'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Title')
                        ],
                        [
                            'id'    => 'image',
                            'type'  => 'uploader',
                            'label' => __('Logo Brand')
                        ],
                        [
                            'id'        => 'link_brand',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Link For Item')
                        ]
                    ]
                ]
            ]
        ]);
    }

    public function getName()
    {
        return __('Brands');
    }

    public function content($model = [])
    {

        return view('blocks.brand.index', $model);
    }
}
