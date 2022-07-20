<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 7/19/2022
 * Time: 4:32 PM
 */

namespace Themes\Demus\Controllers\Blocks;


use Modules\Template\Blocks\BaseBlock;

class Banner extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'    => 'style',
                    'type'  => 'radios',
                    'label' => __('Style'),
                    'std' => 'style_1',
                    'values' => [
                        [
                            'value'   => 'container',
                            'name' => __("Container")
                        ],
                        [
                            'value'   => 'fluid_width',
                            'name' => __("Fluid width")
                        ]
                    ],
                ],
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
                    'id'        => 'content',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Content')
                ],
                [
                    'id'        => 'text_url',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Text For Button')
                ],
                [
                    'id'        => 'url',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Link For Button')
                ],
                [
                    'type'      => "checkbox",
                    'label'     =>__("Color title dark?"),
                    'id'        => "is_dark",
                    'default'   => false
                ],
                [
                    'id'    => 'image',
                    'type'  => 'uploader',
                    'label' => __(' Image Background')
                ],
                [
                    'id'            => 'position',
                    'type'          => 'select',
                    'label'         => __('Position'),
                    'values'        => [
                        [
                            'id'   => 'justify-content-start',
                            'name' => __("Left")
                        ],
                        [
                            'id'   => 'justify-content-end',
                            'name' => __("Right")
                        ],
                        [
                            'id'   => 'justify-content-center',
                            'name' => __("Center")
                        ],
                    ],
                    "selectOptions"=> [
                        'hideNoneSelectedText' => "true"
                    ]
                ],
            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('Banner');
    }

    public function content($model = [])
    {
        return view('blocks.banner.index', $model);
    }
}
