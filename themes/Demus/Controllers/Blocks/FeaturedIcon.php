<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 7/19/2022
 * Time: 4:35 PM
 */

namespace Themes\Demus\Controllers\Blocks;


use Modules\Template\Blocks\BaseBlock;

class FeaturedIcon extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'    => 'style',
                    'type'  => 'radios',
                    'label' => __('Style'),
                    'std'   => 'style_1',
                    'values' => [
                        [
                            'value'     => 'style_1',
                            'name'      => __("Style 1")
                        ],
                        [
                            'value'     => 'style_2',
                            'name'      => __("Style 2")
                        ]
                    ],
                ],
                [
                    'id'    => 'image',
                    'type'  => 'uploader',
                    'label' => __('Banner Image '),
                    'conditions' => ['style' => 'style_1']
                ],
                [
                    'id'        => 'bg_color',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Background Color'),
                    'conditions' => ['style' => 'style_2']
                ],
                [
                    'id'          => 'list_items',
                    'type'        => 'listItem',
                    'label'       => __(' List Items'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Title')
                        ],
                        [
                            'id'        => 'sub_title',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Sub Title')
                        ],
                        [
                            'id'    => 'image_icon',
                            'type'  => 'uploader',
                            'label' => __('Icon Image ')
                        ],
                        [
                            'type'      => "checkbox",
                            'label'     =>__("Color title dark?"),
                            'id'        => "is_dark",
                            'default'   => true
                        ]
                    ]
                ],
            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('Featured Icon');
    }

    public function content($model = [])
    {
        return view("blocks.featured-icon.index", $model);
    }
}
