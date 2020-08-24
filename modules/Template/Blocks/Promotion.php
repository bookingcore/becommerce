<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class Promotion extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'            => 'colItem',
                    'type'          => 'radios',
                    'label'         => __('Item Per Rows'),
                    'values'        => [
                        [
                            'value'   => '6',
                            'name' => __("2 Item")
                        ],
                        [
                            'value'   => '4',
                            'name' => __("3 Item")
                        ],
                        [
                            'value'   => '3',
                            'name' => __("4 Item")
                        ],
                        [
                            'value'   => 'big_and_small',
                            'name' => __("Big & Small (Only use for default template)")
                        ]
                    ]
                ],
                [
                    'id'            => 'styleItem',
                    'type'          => 'radios',
                    'label'         => __('Style Item'),
                    'values'        => [
                        [
                            'value'   => '0',
                            'name' => __("Default")
                        ],
                        [
                            'value'   => '1',
                            'name' => __("Style 1")
                        ],
                    ]
                ],
                [
                    'id'          => 'item',
                    'type'        => 'listItem',
                    'label'       => __('List Items'),
                    'title_field' => 'List Item',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Title')
                        ],
                        [
                            'id'        => 'price',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Price')
                        ],
                        [
                            'id'        => 'sale_price',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Sale Price')
                        ],
                        [
                            'id'        => 'discount',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Discount Percent')
                        ],
                        [
                            'id'            => 'discount_position',
                            'type'          => 'radios',
                            'label'         => __('Discount position (Not used for default template)'),
                            'values'        => [
                                [
                                    'value'   => 'top',
                                    'name' => __("Top")
                                ],
                                [
                                    'value'   => 'bottom',
                                    'name' => __("Bottom")
                                ],
                            ]
                        ],
                        [
                            'id'        => 'link',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Link Product')
                        ],
                        [
                            'id'        => 'desc',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Description Promotion')
                        ],
                        [
                            'id'    => 'image',
                            'type'  => 'uploader',
                            'label' => __('Image Uploader')
                        ],
                    ]
                ],
            ]
        ]);
    }

    public function getName()
    {
        return __('Promotion');
    }

    public function content($model = [])
    {
        $model = [
            'style' =>  $model['styleItem'] ?? 0,
            'item'  =>  $model['item'],
            'colItem' =>$model['colItem']
        ];
        return view('Template::frontend.blocks.Promotion.index', $model);
    }
}
