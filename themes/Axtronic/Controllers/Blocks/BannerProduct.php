<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/27/2022
 * Time: 3:18 PM
 */

namespace Themes\Axtronic\Controllers\Blocks;


use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategory;
use Modules\Template\Blocks\BaseBlock;

class BannerProduct extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'        => 'title_header',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title Header')
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
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title Banner')
                ],
                [
                    'id'        => 'sub_title',
                    'type'      => 'input',
                    'inputType' => 'textArea',
                    'label'     => __('Sub Title Banner')
                ],
                [
                    'id'    => 'image',
                    'type'  => 'uploader',
                    'label' => __('Background Image')
                ],
                [
                    'id'        => 'sub_text',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Sub Text')
                ],
                [
                    'id'        => 'btn_shop_now',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Text For Button')
                ],
                [
                    'id'        => 'link_shop_now',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Link For Button')
                ],
                [
                    'id'            => 'position',
                    'type'          => 'select',
                    'label'         => __('Position Banner'),
                    'value'         => 'right',
                    'values'        => [
                        [
                            'id'   => 'left',
                            'name' => __(" Left")
                        ],
                        [
                            'id'   => 'right',
                            'name' => __(" Right")
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
        return __('Banner Width Product');
    }

    public function content($model = [])
    {
        if(!empty($category_ids = $model['cat_ids'] )) {
            $categories = ProductCategory::select('name','id','slug')->whereIn('id', $category_ids)->get();
        }
        $model['order'] = $model['order'] ?? "id";
        $model['order_by'] = $model['order_by'] ?? "desc";
        $list = Product::search($model)->paginate(2);
        $data = [
            'rows'       => $list,
            'categories' => $categories ?? [],
            'title'      => $model['title'] ?? "",
            'title_header'      => $model['title_header'] ?? "",
            'sub_title'      => $model['sub_title'] ?? "",
            'image'      => $model['image'] ?? "",
            'sub_text'      => $model['sub_text'] ?? "",
            'btn_shop_now'      => $model['btn_shop_now'] ?? "",
            'link_shop_now'      => $model['link_shop_now'] ?? "",
            'position'      => $model['position'] ?? "right",
        ];
        return view("blocks.banner-product.index", $data);
    }
}
