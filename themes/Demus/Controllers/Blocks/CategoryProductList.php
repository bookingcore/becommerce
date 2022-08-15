<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/15/2022
 * Time: 9:45 AM
 */

namespace Themes\Demus\Controllers\Blocks;


use Modules\Template\Blocks\BaseBlock;
use Modules\Product\Models\ProductCategory;

class CategoryProductList extends BaseBlock
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
                    'id'        => 'sub_title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Sub Title')
                ],
                [
                    'id'    => 'style',
                    'type'  => 'radios',
                    'label' => __('Style'),
                    'std' => 'style_1',
                    'values' => [
                        [
                            'value'   => 'style_1',
                            'name' => __("Style 1")
                        ],
                        [
                            'value'   => 'style_2',
                            'name' => __("Style 2")
                        ]
                    ],
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
            ],
            'category'=>__("Product")
        ]);
    }

    public function getName()
    {
        return __('Category Product');
    }

    public function content($model = [])
    {
        if(!empty($category_ids = $model['cat_ids'] )) {
            $categories = ProductCategory::select('name','id','slug','image_id')->whereIn('id', $category_ids)->get();
        }

        $data = [
            'title'                 => $model['title'] ?? "",
            'sub_title'             => $model['sub_title'] ?? "",
            'categories'            => $categories ?? [],
        ];
        $style = !empty($model['style']) ? $model['style'] : 'style_1';
        return view("blocks.category-product.index", $data);
    }
}
