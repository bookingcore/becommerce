<?php
namespace Modules\Product\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategoryRelation;

class ListProductInCategories extends BaseBlock
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
            ]
        ]);
    }

    public function getName()
    {
        return __('Product: List Items In Categories');
    }

    public function content($model = [])
    {
        $model_product = Product::select("*");
        if(empty($model['order'])) $model['order'] = "id";
        if(empty($model['order_by'])) $model['order_by'] = "desc";
        if(empty($model['number'])) $model['number'] = 6;
        if (empty($model['link_product'])) $model['link_product'] = '#';
        if (!empty($category_ids = $model['category_id'] )) {
            $model_product->join('product_category_relations', function ($join) use ($category_ids) {
                $join->on('products.id', '=', 'product_category_relations.target_id')
                    ->whereIn('product_category_relations.cat_id', $category_ids);
            });
        }
        $model_product->orderBy("products.".$model['order'], $model['order_by']);
        $model_product->where("products.status", "publish");
        $model_product->groupBy("products.id");
        $list = $model_product->limit($model['number'])->get();
        $product_url = Product::getLinkForPageSearch();
        $data = [
            'rows'       => $list,
            'title'      => $model['title'],
            'all_product'=> $model['link_product'],
            'link'       => $product_url
        ];
        return view('Product::frontend.blocks.list-product-in-categories.index', $data);
    }
}
