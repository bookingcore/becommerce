<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class BannerHome2 extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'          => 'sliders',
                    'type'        => 'listItem',
                    'label'       => __('Slider Items'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Title')
                        ],
                        [
                            'id'        => 'link',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Link')
                        ],
                        [
                            'id'    => 'image',
                            'type'  => 'uploader',
                            'label' => __('Image Uploader')
                        ]
                    ]
                ],

                [
                    'id'          => 'banner_list',
                    'type'        => 'listItem',
                    'label'       => __('Banner List Items (The first item is for the center bottom column)'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Title')
                        ],
                        [
                            'id'        => 'link',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Link Image')
                        ],
                        [
                            'id'        => 'price_content',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Price content')
                        ],
                        [
                            'id'        => 'price',
                            'type'      => 'input',
                            'inputType' => 'number',
                            'label'     => __('Price')
                        ],
                        [
                            'id'        => 'sale_price',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Sale Price')
                        ],
                        [
                            'id'            => 'discount_text',
                            'type'          => 'input',
                            'inputType'     => 'textArea',
                            'label'         => __('Discount text'),
                        ],
                        [
                            'id'            => 'desc_position',
                            'type'          => 'radios',
                            'label'         => __('Description Position'),
                            'values'        => [
                                [
                                    'value'   => 'top',
                                    'name' => __("Top"),
                                ],
                                [
                                    'value'   => 'bottom',
                                    'name' => __("Bottom")
                                ]
                            ]
                        ],
                        [
                            'id'    => 'image',
                            'type'  => 'uploader',
                            'label' => __('Image Uploader')
                        ]
                    ]
                ]
            ]
        ]);
    }

    public function getName()
    {
        return __('Banner Home 2');
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.BannerHome2.index', $model);
    }
}
