<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 5/13/2022
 * Time: 9:51 PM
 */

namespace Themes\Axtronic\Controllers\Blocks;


use Modules\Product\Models\Product;
use Modules\Template\Blocks\BaseBlock;

class ProductTab extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [

                [
                    'id'            => 'style_list',
                    'type'          => 'radios',
                    'label'         => __('Style Item'),
                    'values'        => [
                        [
                            'value'   => 'style_1',
                            'name' => __("Style 1"),
                        ],
                        [
                            'value'   => 'style_2',
                            'name' => __("Style 2")
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
                    'id'        => 'number',
                    'type'      => 'input',
                    'inputType' => 'number',
                    'label'     => __('Number Item')
                ],
                [
                    'type'=> "checkbox",
                    'label'=>__("Latest Product"),
                    'id'=> "is_latest",
                    'default'=>true
                ],
                [
                    'type'=> "checkbox",
                    'label'=>__("Featured Product"),
                    'id'=> "is_featured",
                    'default'=>true
                ],
                [
                    'type'=> "checkbox",
                    'label'=>__("Top Rated"),
                    'id'=> "is_rate",
                    'default'=>true
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
            ],
            'category'=>__("Product")
        ]);
    }

    public function getName()
    {
        return __('Product Tab');
    }

    public function content($model = [])
    {
        if($model['is_latest'] == true) {
            $model['order'] =  "title";
            $model['order_by'] = $model['order_by'] ?? "asc";
            $model['limit'] = $model['number'] ?? 8;
            $list_latest = Product::search($model)->paginate($model['limit']);
        }
        if($model['is_featured'] == true) {
            $model['order_by'] = $model['order_by'] ?? "asc";
            $model['limit'] = $model['number'] ?? 8;
            $list_featured = Product::search($model)->paginate($model['limit']);
        }
        if($model['is_rate'] == true) {
            $model['order'] =  "rate";
            $model['order_by'] = $model['order_by'] ?? "asc";
            $model['limit'] = $model['number'] ?? 8;
            $list_rate = Product::search($model)->paginate($model['limit']);
        }

        $data = [
            'list_latest'       => $list_latest ?? "",
            'list_featured'       => $list_featured ?? "",
            'list_rate'       => $list_rate ?? "",
            'title'      => $model['title'] ?? "",
            'is_dark'      => $model['is_dark'] ?? true,
            'style_list' => !empty($model['style_list']) ? $model['style_list'] : "style_1",
        ];
        return view('blocks.tab-product.index', $data);
    }
}
