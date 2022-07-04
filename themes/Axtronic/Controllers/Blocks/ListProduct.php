<?php
namespace Themes\Axtronic\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategory;

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
                    'value'         => '',
                    'values'        => [
                        [
                            'value'   => '',
                            'name' => __("Style Normal"),
                        ],
                        [
                            'value'   => 'slide',
                            'name' => __("Style Slide")
                        ],
                        [
                            'value'   => 'normal_bg',
                            'name' => __("Style normal with Background")
                        ],
                        [
                            'value'   => 'slide_bg',
                            'name' => __("Style Slide with Background")
                        ],
                        [
                            'value'   => 'grid',
                            'name' => __("Style Grid"),
                        ],
                    ]
                ],
                [
                    'id'            => 'style_header',
                    'type'          => 'radios',
                    'label'         => __('Title style'),
                    'values'        => [
                        [
                            'value'     => 'left',
                            'name'      => __("Text Left"),
                        ],
                        [
                            'value'   => 'center',
                            'name' => __("Text Center")
                        ],
                    ]
                ],
                [
                    'type'=> "checkbox",
                    'label'=>__("Color title dark?"),
                    'id'=> "is_dark",
                    'default'=>false
                ],
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'      => 'cat_ids',
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
                    'type'=> "checkbox",
                    'label'=>__("Show category name?"),
                    'id'=> "is_category",
                    'default'=>false
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
                ]
            ],
            'category'=>__("Product")
        ]);
    }

    public function getName()
    {
        return __('Product: List item');
    }

    public function content($model = [])
    {
        if(!empty($category_ids = $model['cat_ids'] )) {
            $categories = ProductCategory::select('name','id','slug')->whereIn('id', $category_ids)->get();
        }
        $model['order'] = $model['order'] ?? "id";
        $model['order_by'] = $model['order_by'] ?? "desc";
        $model['limit'] = $model['number'] ?? 5;
        $list = Product::search($model)->paginate($model['limit']);
        $data = [
            'rows'              => $list,
            'title'             => $model['title'] ?? "",
            'is_dark'           => $model['is_dark'] ?? true,
            'categories'        => $categories ?? [],
            'is_category'       => $model['is_category'] ?? false,
            'style_list'        => !empty($model['style_list']) ? $model['style_list'] : "normal",
            'bg_content'        => $model['bg_content'] ?? "",
            'style_header'      => !empty($model['style_header']) ? $model['style_header'] : "",
        ];
        return view('blocks.list-product.'.$data['style_list'], $data);
    }
}
