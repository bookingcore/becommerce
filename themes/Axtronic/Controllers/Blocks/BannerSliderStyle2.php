<?php
namespace Themes\Axtronic\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class BannerSliderStyle2 extends BaseBlock
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
                    'label'       => __('Slider Items Right'),
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
            ],
            'category'=>__("Other")
        ]);
    }
    public function getName()
    {
        return __('BannerText Slider V2');
    }

    public function content($model = [])
    {

        $style = $model['style'] ? $model['style'] : 'index';

        return view("blocks.banner.{$style}", $model);
    }
}
