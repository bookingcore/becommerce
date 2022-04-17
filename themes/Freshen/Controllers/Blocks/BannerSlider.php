<?php
namespace Themes\Freshen\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class BannerSlider extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'    => 'style',
                    'type'  => 'radios',
                    'label' => __('Style'),
                    'value' => 'style_1',
                    'values' => [
                        [
                            'value'   => 'style_1',
                            'name' => __("Style 1")
                        ]
                    ],
                ],
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
                            'value'   => 'slider-fluid',
                            'name' => __("Fluid width")
                        ],
                    ]
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
                    'id'    => 'image_right_1',
                    'type'  => 'uploader',
                    'label' => __('Image Right 1'),
                    'conditions' => ['style' => 'style_1']
                ],
                [
                    'id'        => 'image_right_url_1',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Image Right 1 Url'),
                    'conditions' => ['style' => 'style_1']
                ],
                [
                    'id'    => 'image_right_2',
                    'type'  => 'uploader',
                    'label' => __('Image Right 2'),
                    'conditions' => ['style' => 'style_1']
                ],
                [
                    'id'        => 'image_right_url_2',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Image Right 2 Url'),
                    'conditions' => ['style' => 'style_1']
                ],
            ]
        ]);
    }
    public function getName()
    {
        return __('Banner Slider V2');
    }

    public function content($model = [])
    {

        $style = $model['style'] ? $model['style'] : 'style_1';

        return view("blocks.banner.{$style}", $model);
    }
}
