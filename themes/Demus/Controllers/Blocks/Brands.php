<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/6/2022
 * Time: 3:38 PM
 */

namespace Themes\Demus\Controllers\Blocks;


use Modules\Template\Blocks\BaseBlock;

class Brands extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'            => 'style',
                    'type'          => 'radios',
                    'label'         => __('Style'),
                    'values'        => [
                        [
                            'value'   => '',
                            'name' => __("Style 1")
                        ],
                        [
                            'value'   => 'style_2',
                            'name' => __("Style 2")
                        ],
                        [
                            'value'   => 'style_3',
                            'name' => __("Style 3")
                        ],
                    ]
                ],
                [
                    'id'        => 'bg_color',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Background Color')
                ],
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
            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('Brands');
    }

    public function content($model = [])
    {
        if (empty($model['style'])) {
            $model['style'] = 'index';
        }
        return view('blocks.brands.'.$model['style'], $model);
    }
}
