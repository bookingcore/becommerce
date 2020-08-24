<?php
namespace Modules\Product\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategory;
use Modules\User\Models\UserWishList;

class ListProduct extends BaseBlock
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
                            'value'   => '1',
                            'name' => __("Style 1"),
                        ],
                        [
                            'value'   => '2',
                            'name' => __("Style 2")
                        ]
                    ]
                ],
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'      => 'category_id',
                    'type'    => 'select2',
                    'label'   => __('Filter by Category'),
                    'select2' => [
                        'ajax'  => [
                            'url'      => route("product.admin.category.getForSelect2"),
                            'dataType' => 'json'
                        ],
                        'width' => '100%',
                        'allowClear' => 'true',
                        'multiple' => '1',
                        'placeholder' => __('-- Select --')
                    ],
                    'pre_selected'=>route("product.admin.category.getForSelect2",['pre_selected'=>"1"])
                ],
                [
                    'id'        => 'number',
                    'type'      => 'input',
                    'inputType' => 'number',
                    'label'     => __('Number Item')
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
                ]
            ]
        ]);
    }

    public function getName()
    {
        return __('Product: List Items');
    }

    public function content($model = [])
    {
        $model_product = Product::select("*");
        $categories = [];
        if(empty($model['order'])) $model['order'] = "id";
        if(empty($model['order_by'])) $model['order_by'] = "desc";
        if(empty($model['number'])) $model['number'] = 5;
        if (empty($model['link_product'])) $model['link_product'] = '#';
        if (!empty($category_ids = $model['category_id'] )) {
            $model_product->join('product_category_relations', function ($join) use ($category_ids) {
                $join->on('products.id', '=', 'product_category_relations.target_id')
                    ->whereIn('product_category_relations.cat_id', $category_ids);
            });
            $categories = ProductCategory::select('name','id','slug')->whereIn('id', $category_ids)->get();
        }

        if(!empty($model['is_featured']))
        {
            $model_product->where('is_featured',1);
        }

        $model_product->orderBy("products.".$model['order'], $model['order_by']);
        $model_product->where("products.status", "publish");
        $model_product->groupBy("products.id");
        $list = $model_product->with(['brand','hasWishList'])->limit($model['number'])->get();
        $data = [
            'rows'       => $list,
            'style_list' => $model['style_list'],
            'title'      => $model['title'],
            'categories' => $categories,
            'blocks'     => 'product_list'
        ];
        return view('Product::frontend.blocks.list-space.index', $data);
    }
}
