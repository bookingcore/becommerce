<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 5/5/2022
 * Time: 8:26 AM
 */

namespace Themes\Axtronic\Controllers\Blocks;


use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategory;
use Modules\Template\Blocks\BaseBlock;

class ProductFeature extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'            => 'style_header',
                    'type'          => 'radios',
                    'label'         => __('Title style'),
                    'values'        => [
                        [
                            'value'   => '',
                            'name' => __("Style 1"),
                        ],
                        [
                            'value'   => 'style_2',
                            'name' => __("Style 2")
                        ],
                        [
                            'value'   => 'style_3',
                            'name' => __("Style 3")
                        ],
                    ]
                ],
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'type'=> "checkbox",
                    'label'=>__("Color title dark?"),
                    'id'=> "is_dark",
                    'default'=>false
                ],
                [
                    'id'            => 'order',
                    'type'          => 'select',
                    'label'         => __('Order'),
                    'values'        => [
                        [
                            'id'   => 'id',
                            'name' => __("Date Create")
                        ],
                        [
                            'id'   => 'title',
                            'name' => __("Title")
                        ],
                        [
                            'id'   => 'rate',
                            'name' => __("Rate")
                        ],
                    ],
                    "selectOptions"=> [
                        'hideNoneSelectedText' => "true"
                    ]
                ],
                [
                    'id'            => 'order_by',
                    'type'          => 'select',
                    'label'         => __('Order By'),
                    'values'        => [
                        [
                            'id'   => 'asc',
                            'name' => __("ASC")
                        ],
                        [
                            'id'   => 'desc',
                            'name' => __("DESC")
                        ],
                    ],
                    "selectOptions"=> [
                        'hideNoneSelectedText' => "true"
                    ]
                ],
                [
                    'type'=> "checkbox",
                    'label'=>__("Only featured items?"),
                    'id'=> "is_featured",
                    'default'=>true
                ],
                [
                    'id'    => 'bg_content',
                    'type'  => 'uploader',
                    'label' => __('Background image')
                ],
            ],
            'category'=>__("Product")
        ]);
    }

    public function getName()
    {
        return __('Feature Product ');
    }

    public function content($model = [])
    {

        $model['order'] = $model['order'] ?? "id";
        $model['order_by'] = $model['order_by'] ?? "desc";
        $model['is_featured'] = true;
        $list = Product::search($model)->paginate(7);
        $data = [
            'rows'       => $list,
            'title'      => $model['title'] ?? "",
            'bg_content' => $model['bg_content'] ?? "",
            'style_header' => !empty($model['style_header']) ? $model['style_header'] : "",
            'is_dark'       => $model['is_dark'] ?? false,
        ];
        return view('blocks.feature-product.index', $data);
    }
}
