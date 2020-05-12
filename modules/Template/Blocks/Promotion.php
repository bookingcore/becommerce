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
                    'label'         => ('Item Per Rows'),
                    'values'        => [
                        [
                            'value'   => '6',
                            'name' => ("2 Item")
                        ],
                        [
                            'value'   => '4',
                            'name' => ("3 Item")
                        ],
                        [
                            'value'   => '3',
                            'name' => ("4 Item")
                        ],
                        [
                            'value'   => 'big_and_small',
                            'name' => ("Big & Small")
                        ]
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
        return view('Template::frontend.blocks.Promotion.index', $model);
    }
}
