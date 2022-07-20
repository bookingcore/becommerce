<?php
namespace Themes\Demus\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class Slider extends BaseBlock
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
                            'value'   => 'style_1',
                            'name' => __("Style 1")
                        ],
                        [
                            'value'   => 'style_2',
                            'name' => __("Style 2")
                        ]
                    ],
                ],
                [
                    'id'          => 'sliders',
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
                            'id'        => 'sub_title',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Sub Title')
                        ],
                        [
                            'id'        => 'desc',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Description')
                        ],
                        [
                            'id'    => 'image',
                            'type'  => 'uploader',
                            'label' => __('Image Uploader')
                        ],
                        [
                            'type'      => "checkbox",
                            'label'     =>__("Color title dark?"),
                            'id'        => "is_dark",
                            'default'   => false
                        ],
                        [
                            'id'            => 'position',
                            'type'          => 'select',
                            'label'         => __('Position'),
                            'values'        => [
                                [
                                    'id'   => 'left',
                                    'name' => __("Left")
                                ],
                                [
                                    'id'   => 'right',
                                    'name' => __("Right")
                                ],
                                [
                                    'id'   => 'center',
                                    'name' => __("Center")
                                ],
                            ],
                            "selectOptions"=> [
                                'hideNoneSelectedText' => "true"
                            ]
                        ],
                        [
                            'id'        => 'btn_shop_now',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Text For Button')
                        ],[
                            'id'        => 'link_shop_now',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Link For Button')
                        ]
                    ]
                ]
            ]
        ]);
    }
    public function getName()
    {
        return __('Slider');
    }

    public function content($model = [])
    {
        $style = !empty($model['style']) ? $model['style'] : 'style_1';
        return view("blocks.slider.{$style}", $model);
    }
}
