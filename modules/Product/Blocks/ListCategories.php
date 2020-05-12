<?php
namespace Modules\Product\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Product\Models\ProductCategory;

class ListCategories extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
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
                            'id'   => 'name',
                            'name' => __("Name")
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
            ]
        ]);
    }

    public function getName()
    {
        return __('Categories: List Items');
    }

    public function content($model = [])
    {
        $model_categories = ProductCategory::select("*");
        if(empty($model['order'])) $model['order'] = "id";
        if(empty($model['order_by'])) $model['order_by'] = "desc";
        if(empty($model['number'])) $model['number'] = 8;
        if (empty($model['link_category'])) $model['link_product'] = '#';
        $model_categories->where("product_category.parent_id",null);
        $model_categories->orderBy("product_category.".$model['order'], $model['order_by']);
        $list = $model_categories->limit($model['number'])->get();
        $data = [
            'rows'       => $list,
            'title'      => $model['title'],
            'link_product'=> $model['link_category'],
        ];
        return view('Product::frontend.blocks.list-categories.index', isset($data) ? $data : []);
    }
}
