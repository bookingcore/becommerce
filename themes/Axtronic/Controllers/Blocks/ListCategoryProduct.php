<?php
namespace Themes\Freshen\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategory;

class ListCategoryProduct extends BaseBlock
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
                    'id'      => 'cat_ids',
                    'type'    => 'select2',
                    'label'   => __('Select Categories'),
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
                    'label'     => __('Number Item Per Tab')
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
                ]
            ],
            'category'=>__("Product")
        ]);
    }

    public function getName()
    {
        return __('Product: List Tab Category');
    }

    public function content($model = [])
    {
        $model['order'] = $model['order'] ?? "id";
        $model['order_by'] = $model['order_by'] ?? "desc";
        $model['limit'] = $model['number'] ?? 5;
        $list = Product::search($model)->paginate($model['limit']);

        $list_product_cat = [];
        if(!empty($category_ids = $model['cat_ids'] )) {
            $categories = ProductCategory::select('name','id','slug')->whereIn('id', $category_ids)->get();
            foreach ($categories as $item){
                $model['cat_ids'] = [$item->id];
                $list_item_cat[$item->id] = Product::search($model)->get($model['limit']);
            }
        }

        $data = [
            'rows'       => $list,
            'list_product_cat'       => $list_product_cat,
            'title'      => $model['title'] ?? "",
            'categories' => $categories ?? [],

        ];
        return view('blocks.list-category-product.index', $data);
    }
}
