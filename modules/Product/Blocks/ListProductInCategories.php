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
                    'id'            => 'style_list',
                    'type'          => 'radios',
                    'label'         => __('Style Item'),
                    'values'        => [
                        [
                            'value'   => '0',
                            'name' => __("Default"),
                        ],
                        [
                            'value'   => '1',
                            'name' => __("Style 1")
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
                    'id'        => 'link_all',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Link view all')
                ],
                [
                    'id'          => 'sliders',
                    'type'        => 'listItem',
                    'label'       => __('Slider (Don\'t use sliders for the default theme)'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Title')
                        ],
                        [
                            'id'        => 'link',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Link')
                        ],
                        [
                            'id'    => 'image',
                            'type'  => 'uploader',
                            'label' => __('Image Slider')
                        ],
                    ]
                ],
                [
                    'id'          => 'custom_link',
                    'type'        => 'listItem',
                    'label'       => __('Custom Link (Don\'t use custom link for the default theme)'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Title')
                        ],
                        [
                            'id'        => 'link',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Link')
                        ]
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
        $list = $model_product->with(['brand','hasWishList'])->limit($model['number'])->get();
        $product_url = Product::getLinkForPageSearch();
        $data = [
            'rows'       => $list,
            'title'      => $model['title'],
            'all_product'=> $model['link_product'],
            'style'       => $model['style_list'] ?? 0,
            'sliders'    => $model['sliders'] ?? '',
            'custom_link'=> $model['custom_link'] ?? '',
            'blocks'     => 'product_in_cats',
            'link_all'   => $model['link_all'] ?? ''
        ];
        return view('Product::frontend.blocks.list-product-in-categories.index', $data);
    }
}
