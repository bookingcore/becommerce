<?php
namespace Modules\Product\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategory;

class SlideProduct extends BaseBlock
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
                    'id'        => 'link_view_all',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Link View All')
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
        return __('Product: List Slide');
    }

    public function content($model = [])
    {
        if(!empty($category_ids = $model['category_id'] )) {
            $categories = ProductCategory::select('name','id','slug')->whereIn('id', $category_ids)->get();
        }
        $product = new Product();
        $model['order'] = $model['order'] ?? "id";
        $model['order_by'] = $model['order_by'] ?? "desc";
        $model['limit'] = $model['number'] ?? 5;
        $list = $product->search($model);
        $data = [
            'rows'       => $list,
            'title'      => $model['title'],
            'categories' => $categories ?? [],
            'link_view_all' => $model['link_view_all'] ?? "#",
        ];
        return view('Product::frontend.blocks.slide-product.index', $data);
    }
}
