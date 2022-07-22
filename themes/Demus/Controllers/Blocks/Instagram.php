<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 7/22/2022
 * Time: 11:53 PM
 */

namespace Themes\Demus\Controllers\Blocks;


use Modules\Template\Blocks\BaseBlock;

class Instagram extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'        => 'sub_title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Sub Title')
                ],
                [
                    'id'    => 'style',
                    'type'  => 'radios',
                    'label' => __('Style'),
                    'std' => 'style_1',
                    'values' => [
                        [
                            'value'   => 'normal',
                            'name' => __("Normal")
                        ],
                        [
                            'value'   => 'slider',
                            'name' => __("Slider")
                        ]
                    ],
                ],
                [
                    'id'          => 'list_items',
                    'type'        => 'listItem',
                    'label'       => __(' List Items'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'    => 'image_icon',
                            'type'  => 'uploader',
                            'label' => __('Icon Image ')
                        ],
                    ]
                ],
            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('Instagram');
    }

    public function content($model = [])
    {
        return view("blocks.instagram.".$model['style'], $model);
    }
}
