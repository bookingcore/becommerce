<?php
namespace Themes\Axtronic\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;

class BannerSliderStyle2 extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'            => 'width_slider',
                    'type'          => 'radios',
                    'label'         => __('Slider width'),
                    'values'        => [
                        [
                            'value'   => 'container',
                            'name' => __("Container")
                        ],
                        [
                            'value'   => 'container-fluid',
                            'name' => __("Fluid width")
                        ],
                    ]
                ],
                [
                    'id'          => 'sliders_banner',
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
                            'inputType' => 'textArea',
                            'label'     => __('Sub Title')
                        ],
                        [
                            'id'    => 'image',
                            'type'  => 'uploader',
                            'label' => __('Image Uploader')
                        ],
                        [
                            'id'        => 'sub_text',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Sub Text')
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
                ],
                [
                    'id'          => 'sliders_2',
                    'type'        => 'listItem',
                    'label'       => __('Banner Items Right'),
                    'title_field' => 'title',
                    'settings'    => [
                        [      'id'        => 'sub_title',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Sub Title')
                        ],
                        [      'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Title')
                        ],
                        [
                            'id'        => 'content',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Content')
                        ],
                        [
                            'id'        => 'link',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Link Product')
                        ],
                        [
                            'id'    => 'image',
                            'type'  => 'uploader',
                            'label' => __('Image Uploader')
                        ],
                        [
                            'id'            => 'position',
                            'type'          => 'select',
                            'label'         => __('Position'),
                            'value'         => 'top_left',
                            'values'        => [
                                [
                                    'id'   => 'top_left',
                                    'name' => __("Top Left")
                                ],
                                [
                                    'id'   => 'top_right',
                                    'name' => __("Top Right")
                                ],
                                [
                                    'id'   => 'bottom_left',
                                    'name' => __("Bottom Left")
                                ],
                                [
                                    'id'   => 'bottom_right',
                                    'name' => __("Bottom Right")
                                ],
                                [
                                    'id'   => 'center_right',
                                    'name' => __("Right Center")
                                ],
                                [
                                    'id'   => 'center_left',
                                    'name' => __("Left center")
                                ]

                            ],
                            "selectOptions"=> [
                                'hideNoneSelectedText' => "true"
                            ]
                        ],
                        [
                            'id'            => 'style_color',
                            'type'          => 'select',
                            'label'         => __('Color Text'),
                            'values'        => [
                                [
                                    'id'   => 'dark',
                                    'name' => __("Dark")
                                ],
                                [
                                    'id'   => 'light',
                                    'name' => __("Light")
                                ],
                            ],
                            "selectOptions"=> [
                                'hideNoneSelectedText' => "true"
                            ]
                        ],
                    ]
                ],
                [
                    'type'  => "checkbox",
                    'label' =>__("Show category menu"),
                    'id'    => "is_category",
                    'default'   =>false
                ],
            ],
            'category'=>__("Other")
        ]);
    }
    public function getName()
    {
        return __('Banner Text Slider');
    }

    public function content($model = [])
    {
        return view("blocks.banner-slider.style_2", $model);
    }
}
